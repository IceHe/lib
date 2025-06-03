from collections import defaultdict
from random import randint

# 千分概率
star3_rate = 932  # 93.2%
star4_rate = 60  # 6.0%
star5_rate = 8  # 0.8%
star5_dynamic_rate = [8] * 81
for i in range(66, 71):  # 第 66~70 抽
    star5_dynamic_rate[i] = 8 + 4 * (i - 65)
for i in range(71, 76):  # 第 71~75 抽
    star5_dynamic_rate[i] = 208 + 8 * (i - 70)
for i in range(76, 80):  # 第 76~79 抽
    star5_dynamic_rate[i] = 608 + 10 * (i - 75)
star5_dynamic_rate[80] = 1000  # 第 80 抽必出

# 四星共鸣者
star4_resonators = [
    "丹瑾", "秧秧", "莫特斐", "灯灯", "釉瑚",
    "白芷", "桃祈", "秋水", "炽霞", "散华", "渊武",
]

# 所有四星共鸣者和武器
star4_all = [
    "丹瑾", "秧秧", "莫特斐", "灯灯", "釉瑚",
    "白芷", "桃祈", "秋水", "炽霞", "散华", "渊武",
    "永夜长明", "不归孤军", "无眠烈火", "袍泽之固", "今州守望",
    "异响空灵", "行进序曲", "华彩乐段", "呼啸重音", "奇幻变奏",
    "东落", "西升", "飞逝", "骇行", "异度",
    "永续坍缩", "核熔星盘", "悖论喷流", "凋亡频移", "尘云旋臂",
]

# 常驻五星共鸣者
standard_star5_resonators = [
    "维里奈", "安可", "卡卡罗", "凌阳", "鉴心",
]

star4_resonator_set = set(star4_resonators)
standard_star5_resonator_set = set(standard_star5_resonators)

DEBUG = True


class ConveneSimulator:
    def __init__(self, target: int, freshman: bool):
        if DEBUG:
            print("target:", target, "freshman:", freshman)

        # 当前限定角色卡池轮到哪3个四星角色的出率提升
        self.star4_resonator_up_idx = 0  # 下标标识
        self.star4_resonator_up = star4_resonators[0:3]

        self.featured_guarantee = False  # 是否大保底
        self.convene_10 = 0  # 四星累计10抽必出
        self.convene_80 = 0  # 五星累计80抽必出
        self.convene_all = 0  # 总抽数
        self.star3_count = 0  # 三星数量
        self.star4_count = 0  # 四星数量
        self.star5_count = 0  # 五星数量
        self.counts = defaultdict(int)  # 部分内容的累计数量
        # 送了5个四星角色
        self.counts['秧秧'] += 1  # 游戏一开始送
        self.counts['炽霞'] += 1  # 游戏一开始送
        self.counts['白芷'] += 1  # 第一发常驻池必出
        self.counts['散华'] += 1  # 完成任务送
        self.counts['渊武'] += 1  # 完成任务送

        self.oscillated_coral = 0  # 残振珊瑚数量
        self.afterglow_coral = 0  # 余波珊瑚数量

        # 目标余波珊瑚数量
        self.afterglow_coral_target = target

        if freshman:
            # 新手：加上入坑福利，以及第一个大版本满探索的蓝球资源
            self.init_new_player()
        else:
            # 非新手：假设四星角色全满链，常驻五星角色各一个
            for x in standard_star5_resonators:
                self.counts[x] = 1
            for x in star4_resonators:
                self.counts[x] = 7
            if DEBUG:
                print('非新手：假设四星角色全满链，常驻五星角色各一个')
                for x in self.counts:
                    print(f"{x}: {self.counts[x]} 个")
                print()

    def done(self):
        # 检查是否达到目标余波珊瑚数量
        return self.afterglow_coral >= self.afterglow_coral_target

    def init_new_player(self):
        # 新手入坑福利：定向获取常驻五星角色
        self.afterglow_coral += 15  # 入坑福利：定向获取常驻五星角色
        self.counts['维里奈'] += 1  # 假设选的是维里奈
        if DEBUG:
            print(f"新手入坑福利：定向获取【维里奈】(累计{self.counts['维里奈']}个) 余波珊瑚 {self.afterglow_coral}")

        # 新人常驻抽卡资源：
        # 初霁赠礼 4
        # 初醒之征程 40
        # 开服邮箱赠送 20
        # 今州纪念品商店 5
        # 地图地区满探索奖励 25（个地区）
        # 演练商店 3（今州全息）
        # 海市兑换 7（只计算首个大版本）
        # 先约电台 5（只计算首个大版本）
        # 暂未计入：特殊任务送的，以及2.0蓝球宝箱
        blue_balls = 4 + 40 + 20 + 5 + 25 + 3 + 7 + 5

        convene_blue = 0
        convene_50 = 0
        convene_10 = 0

        # 新手角色池
        def new_player_convene_resonator():
            nonlocal convene_blue, convene_50, convene_10
            convene_blue += 1
            convene_50 += 1
            convene_10 += 1
            if DEBUG:
                print(convene_10 % 10, end='')

            x = randint(0, 999)  # 区间: [0, 1000)
            if convene_50 == 50 or x < star5_rate:
                # 假设新手池抽满50抽，获得15个余波珊瑚
                if DEBUG:
                    print(f"\n抽出五星，累计 {convene_50} 抽", end='')
                convene_50 = 0
                convene_10 = 0
                y = standard_star5_resonators[randint(0, len(standard_star5_resonators) - 1)]
                self.counts[y] += 1
                self.afterglow_coral += 40 if self.counts[y] > 7 else 15
                if DEBUG:
                    print(f"新手池抽出【五星常驻共鸣者】{y} (累计{self.counts[y]}个) 余波珊瑚 {self.afterglow_coral}")
                return True
            elif convene_10 == 10 or x < star4_rate:
                # 假设新手池抽满50抽，获得3个余波珊瑚
                convene_10 = 0
                y = star4_all[randint(0, len(star4_all) - 1)]
                self.counts[y] += 1
                self.afterglow_coral += 8 if self.counts[y] > 7 else 3
                if DEBUG:
                    print(f"新手池抽出【四星内容】{y} (累计{self.counts[y]}个) 余波珊瑚 {self.afterglow_coral}")
                return False
            else:
                self.oscillated_coral += 15
                self.counts["三星"] += 1
                return False

        done = False
        while not done:
            # 新手池 8 个蓝球换 10 抽
            blue_balls -= 8
            for _ in range(10):
                if new_player_convene_resonator():
                    done = True
        if DEBUG:
            print("新手池抽完，开始常驻武器池\n")

        convene_80 = 0
        convene_10 = 0

        # 常驻武器池
        def new_player_convene_weapon():
            nonlocal convene_blue, convene_80, convene_10
            convene_blue += 1
            convene_80 += 1
            convene_10 += 1
            if DEBUG:
                print(convene_10 % 10, end='')

            x = randint(0, 999)  # 区间: [0, 1000)
            if x < star5_dynamic_rate[convene_80]:
                # 常驻五星共鸣者
                if DEBUG:
                    print(f"\n抽出五星，累计 {convene_80} 抽", end='')
                self.afterglow_coral += 15
                convene_80 = 0
                convene_10 = 0
                self.counts["常驻五星武器"] += 1
                if DEBUG:
                    print(f"常驻武器池抽出【常驻五星武器】余波珊瑚 {self.afterglow_coral}")
                return True
            elif convene_10 == 10 or x < star4_rate:
                # 四星内容
                self.afterglow_coral += 3
                convene_10 = 0
                y = star4_all[randint(0, len(star4_all) - 1)]
                self.counts[y] += 1
                if DEBUG:
                    print(f"常驻武器池抽出【四星内容】{y} (累计{self.counts[y]}个) 余波珊瑚 {self.afterglow_coral}")
                return False
            else:
                self.oscillated_coral += 15
                self.counts["三星"] += 1
                return False

        # 剩下的蓝球全部用来抽常驻武器池，抽完为止
        while blue_balls:
            blue_balls -= 1
            new_player_convene_weapon()
        if DEBUG:
            print("新手抽常驻武器池，用完蓝球，新手期模拟结束\n（简化情况，新手期后不再模拟蓝球抽取）\n")

    # 单抽
    def convene(self, is_resonator=True) -> int:
        self.convene_all += 1
        self.convene_80 += 1
        self.convene_10 += 1
        if DEBUG:
            print(self.convene_10 % 10, end='')

        x = randint(0, 999)  # 区间: [0, 1000)
        if x < star5_dynamic_rate[self.convene_80]:
            # 抽出五星
            if DEBUG:
                print(f"抽出五星，累计 {self.convene_80} 抽", end='')
            self.star5_count += 1
            self.convene_80 = 0
            self.convene_10 = 0

            if is_resonator:
                # 限定角色池
                if self.featured_guarantee or randint(0, 1):
                    # 大保底 or 50% 概率获得限定五星共鸣者或武器
                    self.featured_guarantee = False  # 重置为小保底
                    self.counts["限定五星共鸣者"] += 1
                    self.afterglow_coral += 15  # 若限定五星抽满链后溢出，则获得40个余波珊瑚

                    # 抽出限定五星共鸣者后，轮换3个提升出率的四星角色
                    if is_resonator:
                        len_s4 = len(star4_resonators)
                        self.star4_resonator_up_idx += 3
                        self.star4_resonator_up = [
                            star4_resonators[(self.star4_resonator_up_idx + i) % len_s4]
                            for i in range(3)
                        ]
                    if DEBUG:
                        print(f"中了【限定五星共鸣者】，余波珊瑚 {self.afterglow_coral}\n")
                    return 2
                else:
                    # 50%概率获得常驻五星角色
                    self.featured_guarantee = True  # 设置大保底
                    y = randint(0, len(standard_star5_resonators) - 1)
                    std_s5_resonator = standard_star5_resonators[y]
                    self.counts[std_s5_resonator] += 1
                    # 一般获得 15 个余波珊瑚，若已满链（累计抽出7个相同角色后）则获得 45 个
                    self.afterglow_coral += 45 if self.counts[std_s5_resonator] > 7 else 15
                    if DEBUG:
                        print(f"歪了【常驻五星共鸣者】{std_s5_resonator}，余波珊瑚 {self.afterglow_coral}\n")
                    return 1
            else:
                # 限定武器池
                self.counts['五星限定武器'] += 1
                self.afterglow_coral += 15
                if DEBUG:
                    print(f"中了【限定五星武器】，余波珊瑚 {self.afterglow_coral}\n")
                return 2

        elif self.convene_10 == 10 or x < star4_rate:
            # 抽出四星
            self.star4_count += 1
            self.convene_10 = 0

            if is_resonator:
                # 限定角色池
                if randint(0, 1):
                    # 抽出当期出率上升的四星共鸣者
                    y = self.star4_resonator_up[randint(0, 2)]
                    self.counts[y] += 1
                    # 一般获得 3 个余波珊瑚，若已满链（累计抽出7个相同角色后）则获得 8 个
                    self.afterglow_coral += 8 if self.counts[y] > 7 else 3
                    if DEBUG:
                        print(
                            f"抽出当期出率上升的【四星共鸣者UP】{y} (累计{self.counts[y]}个) 余波珊瑚 {self.afterglow_coral}")
                else:
                    # 抽出非当期出率上升的四星共鸣者
                    y = star4_all[randint(0, len(star4_all) - 1)]
                    self.counts[y] += 1
                    if y in star4_resonator_set:
                        self.afterglow_coral += 8 if self.counts[y] > 7 else 3
                    else:
                        self.afterglow_coral += 3
                    if DEBUG:
                        print(
                            f"抽出非当期出率上升的【四星内容】{y} (累计{self.counts[y]}个) 余波珊瑚 {self.afterglow_coral}")
            else:
                # 限定武器池
                y = star4_all[randint(0, len(star4_all) - 1)]
                self.counts[y] += 1
                if y in star4_resonator_set:
                    self.afterglow_coral += 8 if self.counts[y] > 7 else 3
                else:
                    self.afterglow_coral += 3
                if DEBUG:
                    print(f"抽出【四星内容】{y} (累计{self.counts[y]}个) 余波珊瑚 {self.afterglow_coral}")
            return 0

        else:
            # 抽出三星
            self.star3_count += 1
            self.counts["三星"] += 1
            self.oscillated_coral += 15
            return 0


def test_convene():
    afterglow_target = 360

    loop_count = 100000
    # loop_count = 10000
    # loop_count = 1

    # is_freshman = True
    is_freshman = False

    global DEBUG
    DEBUG = False

    print(f"问题：攒够 {afterglow_target} 个余波珊瑚（俗称大珊瑚）要多少次限定唤取？")
    print(f"注意：只算金球和金剑(铸潮波纹)，不算蓝球的抽数")
    print('前提假设：抽齐每期限定角色的 0+1 (即本体+专武)，新手期后不抽任何常驻池')
    print('具体做法：先抽限定角色池，抽出限定角色为止；然后抽限定武器池，抽出限定武器为止')
    if is_freshman:
        print('- 从0开始玩的入坑玩家开始模拟，定向获取常驻五星角色维里奈，')
        print('  只算第一个大版本&满探索能获得的蓝球，先抽完新手池，再全投入常驻武器池')
        print('  至此新手期模拟结束；后续版本送的蓝球不多，为了简化情况，暂且忽略')
    else:
        print('- 假设非新手玩家，四星角色全满链，常驻五星角色各一个')
        print('  新手期后不再模拟蓝球抽取，直接进入限定池模拟')
    print('- 限定角色池会自动轮换3个提升出率的四星角色')
    print('- 模拟 65 抽后，限定角色或武器出率持续上升的情况，参考 @一颗平衡树 的公式')
    print()

    convene_total = 0
    resonator_total = 0
    standard_resonator_total = 0
    weapon_total = 0

    min_convene = float('inf')
    max_convene = 0
    freshman_coral_total = 0

    coral_from_resonator = 0
    coral_from_weapon = 0

    for i in range(loop_count):
        if DEBUG:
            print(f"【第 {i} 模拟开始】\n")

        simulator = ConveneSimulator(target=afterglow_target, freshman=is_freshman)
        freshman_coral_total += simulator.afterglow_coral

        resonator_count = 0
        weapon_count = 0
        while not simulator.done():
            prev_coral = simulator.afterglow_coral

            if DEBUG:
                print("「先抽限定角色池」")
                print("当前限定角色池提升出率的四星角色：", simulator.star4_resonator_up)
            while not simulator.done():
                result = simulator.convene(is_resonator=True)
                if result == 2:
                    resonator_count += 1
                    coral_from_resonator += simulator.afterglow_coral - prev_coral
                    prev_coral = simulator.afterglow_coral
                    break
                elif result == 1:
                    standard_resonator_total += 1
                    coral_from_resonator += simulator.afterglow_coral - prev_coral
                    prev_coral = simulator.afterglow_coral

            if DEBUG:
                print("「再抽限定武器池」")
            while not simulator.done():
                result = simulator.convene(is_resonator=False)
                if result == 2:
                    weapon_count += 1
                    coral_from_weapon += simulator.afterglow_coral - prev_coral
                    # prev_coral = simulator.afterglow_coral
                    break

        if DEBUG:
            for x in standard_star5_resonators:
                print(f"{x}: {simulator.counts[x]} 个")
            for x in star4_resonators:
                print(f"{x}: {simulator.counts[x]} 个")

        print(
            f"\n【第 {i} 次模拟要 {simulator.convene_all} 抽，抽出 {resonator_count} 个五星角色、{weapon_count} 个五星武器】\n")
        convene_total += simulator.convene_all
        resonator_total += resonator_count
        weapon_total += weapon_count
        min_convene = min(min_convene, simulator.convene_all)
        max_convene = max(max_convene, simulator.convene_all)

    print()
    if is_freshman:
        print(f"【萌新】模拟 {loop_count} 次")
        print(f"【新手期模拟：平均每次模拟获得 {(freshman_coral_total / loop_count, 2)} 个余波珊瑚】")
    else:
        print(f"【四星满链老登】模拟 {loop_count} 次")

    print(f"【平均要 {round(convene_total / loop_count, 2)} 抽，最少 {min_convene} 抽，最多 {max_convene} 抽】")
    print(f"【抽出 {round(resonator_total / loop_count, 2)} 个限定五星共鸣者、{round(weapon_total / loop_count, 2)} 个五星武器】")
    print(f"【抽出 {round(standard_resonator_total / loop_count, 2)} 个常驻五星共鸣者】")
    print(f"【平均每次限定角色池保底能获得 {round(coral_from_resonator / (resonator_total + standard_resonator_total), 2)}】")
    print(f"【平均每次限定武器池保底能获得 {round(coral_from_weapon / weapon_total, 2)}】")


if __name__ == "__main__":
    test_convene()
