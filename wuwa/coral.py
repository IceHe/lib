from collections import defaultdict
from random import randint

# 千分概率
star5_rate = 8  # 0.8%
star4_rate = 60  # 6.0%
star3_rate = 932  # 93.2%

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

# 标准五星共鸣者
standard_star5_resonators = [
    "维里奈", "安可", "卡卡罗", "凌阳", "鉴心",
]

star4_resonator_set = set(star4_resonators)
standard_star5_resonator_set = set(standard_star5_resonators)

DEBUG = True


class ConveneSimulator:
    def __init__(self, afterglow_target: int):
        # 当前限定角色卡池轮到哪3个四星角色的出率提升
        self.star4_resonator_up_idx = 0  # 下标标识
        self.star4_resonator_up = star4_resonators[0:3]

        self.featured_guarantee = False  # 是否大保底
        self.convene_10 = 0  # 四星后累计10抽
        self.convene_80 = 0  # 五星后累计80抽
        self.convene_all = 0  # 总抽数
        self.star3_count = 0  # 三星数量
        self.star4_count = 0  # 四星数量
        self.star5_count = 0  # 五星数量
        self.counts = defaultdict(int)  # 部分内容的累计数量

        self.afterglow_coral = 0  # 余波珊瑚数量
        self.oscillated_coral = 0  # 残振珊瑚数量

        # 目标余波珊瑚数量
        self.afterglow_coral_target = afterglow_target

    def done(self):
        # 检查是否达到目标余波珊瑚数量
        return self.afterglow_coral >= self.afterglow_coral_target

    # 单抽
    def convene(self, isResonator=True) -> bool:
        self.convene_all += 1
        self.convene_80 += 1
        self.convene_10 += 1
        if DEBUG:
            print(self.convene_10 % 10, end='')

        x = randint(0, 999)
        if self.convene_80 == 80 or x < star5_rate:
            # 抽出五星
            if DEBUG:
                print(f"抽出五星，累计 {self.convene_80} 抽", end='')
            self.star5_count += 1
            self.convene_80 = 0
            self.convene_10 = 0

            if isResonator:
                # 武器池
                if self.featured_guarantee or randint(0, 1):
                    # 大保底 or 50% 概率获得限定五星共鸣者或武器
                    self.featured_guarantee = False
                    self.counts["限定五星共鸣者"] += 1
                    self.afterglow_coral += 15  # 若限定五星抽满链后溢出，则获得40个余波珊瑚

                    # 抽出限定五星共鸣者后，轮换3个提升出率的四星角色
                    if isResonator:
                        len_s4 = len(star4_resonators)
                        self.star4_resonator_up_idx += 3
                        self.star4_resonator_up = [
                            star4_resonators[(self.star4_resonator_up_idx + i) % len_s4]
                            for i in range(3)
                        ]
                    if DEBUG:
                        print(f"中了限定五星共鸣者，余波珊瑚 {self.afterglow_coral}\n")
                    return True
                else:
                    # 50%概率获得标准五星角色
                    self.featured_guarantee = True
                    y = randint(0, len(standard_star5_resonators) - 1)
                    std_s5_resonator = standard_star5_resonators[y]
                    self.counts[std_s5_resonator] += 1
                    # 一般获得 15 个余波珊瑚，若已满链（累计抽出7个相同角色后）则获得 45 个
                    self.afterglow_coral += 45 if self.counts[std_s5_resonator] > 7 else 15
                    if DEBUG:
                        print(f"歪了标准五星共鸣者 {std_s5_resonator}，余波珊瑚 {self.afterglow_coral}\n")
                    return False
            else:
                # 获得五星武器
                self.featured_guarantee = False
                self.counts['五星限定武器'] += 1
                # 一般获得 15 个余波珊瑚，若已满链（累计抽出7个相同角色后）则获得 45 个
                self.afterglow_coral += 15
                if DEBUG:
                    print(f"中了限定五星武器，余波珊瑚 {self.afterglow_coral}\n")
                return True

        elif self.convene_10 == 10 or x < star4_rate:
            # 抽出四星
            self.star4_count += 1
            self.convene_10 = 0

            if isResonator:
                # 限定角色池
                if randint(0, 1):
                    # 抽出当期出率上升的四星共鸣者
                    y = self.star4_resonator_up[randint(0, 2)]
                    self.counts[y] += 1
                    # 一般获得 3 个余波珊瑚，若已满链（累计抽出7个相同角色后）则获得 8 个
                    self.afterglow_coral += 8 if self.counts[y] > 7 else 3
                    if DEBUG:
                        print(f"抽出当期出率上升的四星共鸣者 {y} (累计{self.counts[y]}个) 余波珊瑚 {self.afterglow_coral}")
                else:
                    # 抽出非当期出率上升的四星共鸣者
                    y = star4_all[randint(0, len(star4_all) - 1)]
                    self.counts[y] += 1
                    self.afterglow_coral += 3
                    if DEBUG:
                        print(f"抽出非当期出率上升的四星内容 {y} (累计{self.counts[y]}个) 余波珊瑚 {self.afterglow_coral}")

            else:
                # 限定武器池
                y = star4_all[randint(0, len(star4_all) - 1)]
                self.counts[y] += 1
                self.afterglow_coral += 3
                if DEBUG:
                    print(f"抽出四星内容 {y} (累计{self.counts[y]}个) 余波珊瑚 {self.afterglow_coral}")

            return False

        else:
            # 抽出三星
            self.star3_count += 1
            self.counts["三星"] += 1
            self.oscillated_coral += 15
            return False


def test_convene():
    afterglow_target = 360 * 3
    loop_count = 100000
    global DEBUG
    DEBUG = False
    
    print(f"问题：攒够 {afterglow_target} 个余波珊瑚（俗称大珊瑚）要唤取多少次？")
    print('前提假设：图鉴党玩家，抽齐每期限定角色的 0+1，但不抽任何常驻池')
    print('具体做法：先抽限定角色池，抽出限定角色为止；然后抽限定武器池，抽出限定武器为止')
    print('模拟实际情况：限定角色池会自动轮换3个提升出率的四星角色')
    print('忽略情况：暂不模拟 60 抽后，限定角色或武器出率持续上升的情况（因为不确定机制）')
    print()

    convene_total = 0
    resonator_total = 0
    weapon_total = 0
    for i in range(loop_count):
        if DEBUG:
            print(f"【第 {i} 模拟开始】\n")

        simulator = ConveneSimulator(afterglow_target=afterglow_target)
        resonator_count = 0
        weapon_count = 0
        while not simulator.done():
            if DEBUG:
                print("「先抽限定角色池」")
                print("当前限定角色池提升出率的四星角色：", simulator.star4_resonator_up)
            while not simulator.done():
                if simulator.convene(isResonator=True):
                    resonator_count += 1
                    break

            if DEBUG:
                print("「再抽限定武器池」")
            while not simulator.done():
                if simulator.convene(isResonator=False):
                    weapon_count += 1
                    break

        if DEBUG:
            for x in standard_star5_resonators:
                print(f"{x}: {simulator.counts[x]} 个")
            for x in star4_resonators:
                print(f"{x}: {simulator.counts[x]} 个")

        print(f"\n【第 {i} 次模拟要 {simulator.convene_all} 抽，抽出 {resonator_count} 个五星角色、{weapon_count} 个五星武器】\n")
        convene_total += simulator.convene_all
        resonator_total += resonator_count
        weapon_total += weapon_count

    print(f"\n【平均每次模拟要 {convene_total / loop_count:.2f} 抽，抽出 {resonator_total / loop_count:.2f} 个五星角色、{weapon_total / loop_count:.2f} 个五星武器】")


if __name__ == "__main__":
    test_convene()
