from collections import defaultdict
from random import randint

# 千分概率
star3_rate = 932  # 93.2%
star4_rate = 60  # 6.0%
star5_rate = 8  # 0.8%

# 参考B站 @一颗平衡树 提供的概率公式
# 初始化 第 1~65 抽
star5_dynamic_rate = [8] * (80+1)
for i in range(66, 71):  # 第 66~70 抽
    star5_dynamic_rate[i] = 8 + 40 * (i - 65)
for i in range(71, 76):  # 第 71~75 抽
    star5_dynamic_rate[i] = 208 + 80 * (i - 70)
for i in range(76, 80):  # 第 76~79 抽
    star5_dynamic_rate[i] = 608 + 100 * (i - 75)
star5_dynamic_rate[80] = 1000  # 第 80 抽必出

# 四星角色
star4_resonators = [
    "丹瑾", "秧秧", "莫特斐", "灯灯", "釉瑚",
    "白芷", "桃祈", "秋水", "炽霞", "散华",
    "渊武", '卜灵',
]

star4_resonator_set = set(star4_resonators)

# 四星武器
star4_weapons = [
    "永夜长明", "不归孤军", "无眠烈火", "袍泽之固", "今州守望",
    "异响空灵", "行进序曲", "华彩乐段", "呼啸重音", "奇幻变奏",
    "东落", "西升", "飞逝", "骇行", "异度",
    "永续坍缩", "核熔星盘", "悖论喷流", "凋亡频移", "尘云旋臂",
]

# 所有四星内容（角色和武器）
star4_all = star4_resonators + star4_weapons

# 常驻五星角色
standard_star5_resonators = [
    "维里奈", "安可", "卡卡罗", "凌阳", "鉴心",
]

DEBUG = True

# 抽卡模拟器
class ConveneSimulator:
    def __init__(self, target: int, freshman: bool):
        if DEBUG:
            print("target:", target, "freshman:", freshman)

        # 当前限定角色卡池轮到哪3个四星角色的出率提升
        self.star4_resonator_up_idx = 0  # 下标标识
        self.star4_resonator_up = star4_resonators[0:3]
        self.star4_resonator_nonup = star4_resonators[3:]

        # 当前限定武器卡池轮到哪3个四星武器的出率提升
        self.star4_weapon_up_idx = 0  # 下标标识
        self.star4_weapon_up = star4_weapons[0:3]
        self.star4_weapon_nonup = star4_weapons[3:]

        self.star5_up_guarantee = False  # 是否5星up大保底
        self.star4_up_guarantee = False  # 是否4星up大保底
        self.convene_10 = 0  # 10抽内计数：四星累计10抽必出
        self.convene_80 = 0  # 80抽内计数：五星累计80抽必出
        self.convene_all = 0  # 总抽数
        self.star3_count = 0  # 三星数量
        self.star4_count = 0  # 四星数量
        self.star5_count = 0  # 五星数量
        self.counts = defaultdict(int)  # 内容计数
        self.gains = defaultdict(int)  # 内容的获得量
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
            # 非新手：假设四星角色和常驻五星角色全满链
            for x in standard_star5_resonators:
                self.counts[x] = 7
            for x in star4_resonators:
                self.counts[x] = 7
            if DEBUG:
                print('非新手：假设四星角色和常驻五星角色全满链')
                for x in self.counts:
                    print(f"{x}: {self.counts[x]} 个")
                print()

    def done(self):
        # 检查余波珊瑚是否达到目标数量
        return self.afterglow_coral >= self.afterglow_coral_target

    # 抽出五星角色，累计余波珊瑚
    def incr_star5_resonator(self, star5_name: str):
        self.counts[star5_name] += 1
        self.gains[star5_name] += 1
        self.afterglow_coral += 40 if self.counts[star5_name] > 7 else 15
        if DEBUG:
            print(f"抽出【五星角色】{star5_name} (累计{self.counts[star5_name]}个) 余波珊瑚累计 {self.afterglow_coral}")

    # 抽出四星角色，累计余波珊瑚
    def incr_star4_resonator(self, star4_name: str):
        self.counts[star4_name] += 1
        self.gains[star4_name] += 1
        self.afterglow_coral += 8 if self.counts[star4_name] > 7 else 3
        if DEBUG:
            print(f"抽出【四星角色】{star4_name} (累计{self.counts[star4_name]}个) 余波珊瑚累计 {self.afterglow_coral}")

    # 抽出四星武器，累计余波珊瑚
    def incr_star4_weapon(self, star4_name: str):
        self.counts[star4_name] += 1
        self.gains[star4_name] += 1
        self.afterglow_coral += 3
        if DEBUG:
            print(f"抽出【四星武器】{star4_name} (累计{self.counts[star4_name]}个) 余波珊瑚累计 {self.afterglow_coral}")

    def init_new_player(self):
        pass
        # # 新手入坑福利：定向获取常驻五星角色
        # self.afterglow_coral += 15  # 入坑福利：定向获取常驻五星角色
        # self.counts['维里奈'] += 1  # 假设选的是维里奈
        # if DEBUG:
        #     print(f"新手入坑福利：定向获取【维里奈】(累计{self.counts['维里奈']}个) 余波珊瑚累计 {self.afterglow_coral}")

        # # FIXME: 新人入坑福利改版了，目前计算逻辑还没改
        # # 新人常驻抽卡资源：
        # # 初霁赠礼 4
        # # 初醒之征程 40
        # # 开服邮箱赠送 20
        # # 今州纪念品商店 5
        # # 地图地区满探索奖励 25（个地区）
        # # 演练商店 3（今州全息）
        # # 海市兑换 7（只计算首个大版本）
        # # 先约电台 5（只计算首个大版本）
        # # 暂未计入：特殊任务送的，以及2.0蓝球宝箱
        # blue_balls = 4 + 40 + 20 + 5 + 25 + 3 + 7 + 5

        # convene_blue = 0
        # convene_50 = 0
        # convene_10 = 0

        # # 新手角色池
        # def new_player_convene_resonator():
        #     nonlocal convene_blue, convene_50, convene_10
        #     convene_blue += 1
        #     convene_50 += 1
        #     convene_10 += 1
        #     if DEBUG:
        #         print(convene_10 % 10, end='')

        #     x = randint(0, 999)  # 区间: [0, 1000)
        #     # 新手池50抽后关闭
        #     if convene_50 == 50 or x < star5_rate: #抽出五星
        #         if DEBUG:
        #             print(f"\n抽出常驻五星角色，累计 {convene_50} 抽", end='')
        #         convene_50 = 0
        #         convene_10 = 0
        #         std_star5_name = standard_star5_resonators[randint(0, len(standard_star5_resonators) - 1)]
        #         self.incr_star5_resonator(std_star5_name)
        #         return True
        #     elif convene_10 == 10 or x < star4_rate: # 抽出四星
        #         convene_10 = 0
        #         y = star4_all[randint(0, len(star4_all) - 1)]
        #         self.incr_star4_resonator(y)
        #         return False
        #     else:
        #         self.oscillated_coral += 15
        #         self.counts["三星"] += 1
        #         return False

        # done = False
        # while not done:
        #     # 新手池 8 个蓝球换 10 抽
        #     blue_balls -= 8
        #     for _ in range(10):
        #         if new_player_convene_resonator():
        #             done = True
        # if DEBUG:
        #     print("新手角色池抽完，开始抽常驻武器池\n")

        # convene_80 = 0
        # convene_10 = 0

        # # 常驻武器池
        # def new_player_convene_weapon():
        #     nonlocal convene_blue, convene_80, convene_10
        #     convene_blue += 1
        #     convene_80 += 1
        #     convene_10 += 1
        #     if DEBUG:
        #         print(convene_10 % 10, end='')

        #     x = randint(0, 999)  # 区间: [0, 1000)
        #     if x < star5_dynamic_rate[convene_80]:
        #         if DEBUG:
        #             print(f"\n抽出常驻五星武器，累计 {convene_80} 抽", end='')
        #         self.afterglow_coral += 15
        #         convene_80 = 0
        #         convene_10 = 0
        #         self.counts["常驻五星武器"] += 1
        #         if DEBUG:
        #             print(f"常驻武器池抽出【常驻五星武器】余波珊瑚累计 {self.afterglow_coral}")
        #         return True
        #     elif convene_10 == 10 or x < star4_rate:
        #         # 四星内容
        #         self.afterglow_coral += 3
        #         convene_10 = 0
        #         y = star4_all[randint(0, len(star4_all) - 1)]
        #         self.counts[y] += 1
        #         if DEBUG:
        #             print(f"常驻武器池抽出【四星】{y} (累计{self.counts[y]}个) 余波珊瑚累计 {self.afterglow_coral}")
        #         return False
        #     else:
        #         self.oscillated_coral += 15
        #         self.counts["三星"] += 1
        #         return False

        # # 剩下的蓝球全部用来抽常驻武器池，抽完为止
        # while blue_balls:
        #     blue_balls -= 1
        #     new_player_convene_weapon()
        # if DEBUG:
        #     print("抽常驻武器池，用完蓝球，新手期模拟结束\n（简化情况，新手期后不再模拟蓝球抽取）\n")

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
            # self.star4_up_guarantee = False  # 重置4星大保底 # 注意: 抽出五星不影响4星保底
            if DEBUG:
                print(f"抽出五星，累计 {self.convene_80} 抽", end='')
            self.star5_count += 1
            self.convene_80 = 0
            self.convene_10 = 0

            if is_resonator:
                # 限定角色池
                if self.star5_up_guarantee or randint(0, 1):
                    # 大保底必定获得 or 50%概率获得 → 限定5星角色
                    self.star5_up_guarantee = False  # 重置5星大保底
                    self.incr_star5_resonator("限定五星角色")
                    # FIXME：模拟场景是「抽调整器」，暂定只在一期卡池内连续抽，不考虑四星角色轮换的情况
                    # # 抽出限定五星角色后，轮换3个提升出率的四星角色
                    # if is_resonator:
                    #     len_s4 = len(star4_resonators)
                    #     self.star4_resonator_up_idx += 3
                    #     self.star4_resonator_up = [
                    #         star4_resonators[(self.star4_resonator_up_idx + i) % len_s4]
                    #         for i in range(3)
                    #     ]
                    return 2 # 抽出限定五星角色
                else:
                    # 50%概率获得 常驻五星角色（歪了）
                    self.star5_up_guarantee = True  # 设置5星大保底
                    self.afterglow_coral += 30 # 歪了，将额外获得 30 个余波珊瑚
                    t = randint(0, len(standard_star5_resonators) - 1)
                    std_s5_resonator = standard_star5_resonators[t]
                    self.incr_star5_resonator(std_s5_resonator)
                    return 1 # 抽出常驻五星角色（歪了）
            else:
                # 限定武器池
                self.star5_up_guarantee = False  # 重置5星大保底
                self.counts['五星限定武器'] += 1
                self.afterglow_coral += 15
                if DEBUG:
                    print(f"出了【限定五星武器】，余波珊瑚累计 {self.afterglow_coral}\n")
                return 2 # 抽出限定五星武器

        elif self.convene_10 == 10 or x < (star5_dynamic_rate[self.convene_80] + star4_rate):
            # 抽出四星
            self.star4_count += 1
            self.convene_10 = 0

            if is_resonator:
                # 限定角色池
                if self.star4_up_guarantee or randint(0, 1):
                    # 大保底必定获得 or 50%概率获得 → 当期4星角色UP
                    self.star4_up_guarantee = False  # 重置4星大保底
                    t = self.star4_resonator_up[randint(0, 2)]
                    if DEBUG:
                        print(f"出了【四星角色UP】{t}")
                    self.incr_star4_resonator(t)
                else:
                    # 50% 抽出非当期UP的四星内容
                    self.star4_up_guarantee = True  # 设置4星大保底
                    is_resonator = randint(0, 1)
                    if is_resonator: # 四星角色
                        t = self.star4_resonator_nonup[randint(0, len(self.star4_resonator_nonup) - 1)]
                        self.incr_star4_resonator(t)
                    else: # 四星武器
                        t = star4_weapons[randint(0, len(star4_weapons) - 1)]
                        self.incr_star4_weapon(t)
            else:
                # 限定武器池
                if self.star4_up_guarantee or randint(0, 1):
                    # 大保底必定获得 or 50%概率获得 → 当期4星武器UP
                    self.star4_up_guarantee = False  # 重置4星大保底
                    t = self.star4_weapon_up[randint(0, 2)]
                    if DEBUG:
                        print(f"出了【四星武器UP】{t}")
                    self.incr_star4_weapon(t)
                else:
                    # 50% 抽出非当期UP的四星内容
                    self.star4_up_guarantee = True  # 设置4星大保底
                    is_resonator = randint(0, 1)
                    if is_resonator: # 四星角色
                        t = star4_resonators[randint(0, len(star4_resonators) - 1)]
                        self.incr_star4_resonator(t)
                    else: # 四星武器
                        t = self.star4_weapon_nonup[randint(0, len(self.star4_weapon_nonup) - 1)]
                        self.incr_star4_weapon(t)
            return 0

        else:
            # 抽出三星
            self.star3_count += 1
            self.counts["三星武器"] += 1
            self.oscillated_coral += 15
            return 0


def test_convene():
    afterglow_target = 6000

    # loop_count = 100000
    loop_count = 10000
    # loop_count = 1000
    # loop_count = 100
    # loop_count = 1

    # is_freshman = True
    is_freshman = False

    global DEBUG
    DEBUG = False

    print(f"问题：攒够 {afterglow_target} 个余波珊瑚（俗称大珊瑚）要多少次限定唤取？")
    print(f"注意：只算金球和铸潮波纹，不算蓝球的抽数")
    # print('前提假设：先抽限定武器+5，再一直抽限定角色池')
    print('具体做法：先抽限定武器+5，再一直抽限定角色池，直到攒够目标余波珊瑚数量为止')
    if is_freshman:
        print('- 从0开始玩的入坑玩家开始模拟，定向获取常驻五星角色维里奈，')
        print('  只算第一个大版本&满探索能获得的蓝球，先抽完新手池，再全投入常驻武器池')
        print('  至此新手期模拟结束；后续版本送的蓝球不多，为了简化情况，暂且忽略')
    else:
        print('- 假设四星角色全满链，常驻五星角色也全满链，当期限定五星角色从0开始抽')
        # print('  不模拟蓝球抽取，直接进入限定池模拟')
    # print('- 限定角色池会自动轮换3个提升出率的四星角色')
    print('- 每 80 抽，抽到第 65 抽后，限定角色或武器出率持续上升的情况，参考 @一颗平衡树 的公式')
    print()

    convene_total = 0
    resonator_total = 0
    standard_resonator_total = 0
    weapon_total = 0

    star4_resonator_total = 0
    star4_weapon_total = 0

    star4_resonator_counts = defaultdict(int)
    star4_weapon_counts = defaultdict(int)
    convene_counts = defaultdict(int)

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

        if DEBUG:
            print("「抽限定武器池+5」")
        prev_coral = simulator.afterglow_coral
        while not simulator.done():
            result = simulator.convene(is_resonator=False)
            if result == 2:
                weapon_count += 1
                coral_from_weapon += simulator.afterglow_coral - prev_coral
                prev_coral = simulator.afterglow_coral
                if DEBUG:
                    print(f"抽出第 {weapon_count} 个五星武器，余波珊瑚累计 {simulator.afterglow_coral}\n\n")
                if weapon_count >= 5:
                    break

        if DEBUG:
            print("「抽限定角色池+N，直到攒够6千大珊瑚」")
            print("当前限定角色池提升出率的四星角色：", simulator.star4_resonator_up)
        prev_coral = simulator.afterglow_coral
        while not simulator.done():
            result = simulator.convene(is_resonator=True)
            if result == 2:
                resonator_count += 1
                coral_from_resonator += simulator.afterglow_coral - prev_coral
                prev_coral = simulator.afterglow_coral
            elif result == 1:
                standard_resonator_total += 1
                coral_from_resonator += simulator.afterglow_coral - prev_coral
                prev_coral = simulator.afterglow_coral

        for x in star4_resonators:
            star4_resonator_total += simulator.gains[x]
            star4_resonator_counts[x] += simulator.gains[x]
        for x in star4_weapons:
            star4_weapon_total += simulator.gains[x]
            star4_weapon_counts[x] += simulator.gains[x]

        if DEBUG:
            for x in standard_star5_resonators:
                print(f"{x}: {simulator.counts[x]} 个")
            for x in star4_resonators:
                print(f"{x}: {simulator.counts[x]} 个")

        if DEBUG:
            print(f"\n【第 {i} 次模拟要 {simulator.convene_all} 抽，抽出 {resonator_count} 个五星角色、{weapon_count} 个五星武器】\n")
        convene_total += simulator.convene_all
        convene_counts[simulator.convene_all] += 1
        resonator_total += resonator_count
        weapon_total += weapon_count
        min_convene = min(min_convene, simulator.convene_all)
        max_convene = max(max_convene, simulator.convene_all)

    print()
    if is_freshman:
        print(f"【萌新】模拟 {loop_count} 次")
        print(f"【新手期模拟：平均每次模拟获得 {round(freshman_coral_total / loop_count, 2)} 个余波珊瑚】")
    else:
        print(f"【四星+常驻五星满链老登】模拟 {loop_count} 次")

    print(f"【平均要 {round(convene_total / loop_count, 2)} 抽，最少 {min_convene} 抽，最多 {max_convene} 抽】")
    # print(f"【抽出 {round(resonator_total / loop_count, 2)} 个限定五星角色、{round(weapon_total / loop_count, 2)} 个五星武器】")
    print(f"【平均抽出 {round(resonator_total / loop_count, 2)} 个限定五星角色】")
    print(f"【平均抽出 {round(standard_resonator_total / loop_count, 2)} 个常驻五星角色】")
    print(f"【平均抽出 {round(weapon_total / loop_count, 2)} 个五星武器】")
    # print(f"【总共抽出 {round((resonator_total + standard_resonator_total) / loop_count, 2)} 个五星角色】")
    print(f"【平均抽出 {round(star4_resonator_total / loop_count, 2)} 个四星角色】")
    print(f"【平均抽出 {round(star4_weapon_total / loop_count, 2)} 个四星武器】")
    # print(f"【平均每次限定角色池保底能获得 {round(coral_from_resonator / (resonator_total + standard_resonator_total), 2)}】")
    # print(f"【平均每次限定武器池保底能获得 {round(coral_from_weapon / weapon_total, 2)}】")

    star4_total = star4_resonator_total + star4_weapon_total
    percent_all = 0.0
    for x in star4_resonators[0:3]:
        print(f"四星角色UP {x} 数量 {star4_resonator_counts[x]} 占比 {round(star4_resonator_counts[x] / star4_total * 100, 2)}%")
        percent_all += star4_resonator_counts[x] / star4_total * 100
    for x in star4_resonators[3:]:
        print(f"四星角色 {x} 数量 {star4_resonator_counts[x]} 占比 {round(star4_resonator_counts[x] / star4_total * 100, 2)}%")
        percent_all += star4_resonator_counts[x] / star4_total * 100
    for x in star4_weapons:
        print(f"四星武器 {x} 数量 {star4_weapon_counts[x]} 占比 {round(star4_weapon_counts[x] / star4_total * 100, 2)}%")
        percent_all += star4_weapon_counts[x] / star4_total * 100
    print(f"总占比 {round(percent_all, 2)}%")

    gap = 50
    stats = [0] * ((max_convene - min_convene) // gap + 1)
    for i in range(min_convene, max_convene + 1):
        x = convene_counts[i]
        if x:
            stats[(i - i % gap - min_convene) // gap] += x
            # print(f"{i} 抽: {x} 次")

    for i in range(len(stats)):
        print(f"{min_convene + i * gap}~{min_convene + (i + 1) * gap - 1}\t{stats[i] / loop_count * 100:.2f}%\t{stats[i]}")

if __name__ == "__main__":
    test_convene()
