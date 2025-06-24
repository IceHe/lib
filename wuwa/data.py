# 13种词条的千分概率
from collections import defaultdict

# 下标 -> 副词条
WORD = [
    "暴击",
    "暴击伤害",
    ################
    "攻击",
    "防御",
    "生命",
    ################
    "攻击固定值",
    "防御固定值",
    "生命固定值",
    ################
    "共鸣效率",
    "普攻",
    "重击",
    "共鸣技能",
    "共鸣解放",
    ################
]

# 词条位图 substat slot bitmap
CRIT = 1 << 0  # 暴击
CRIT_DMG = 1 << 1  # 暴击伤害
ATK = 1 << 2  # 攻击（百分比）
ATK_FIXED = 1 << 5  # 攻击固定值
ENERGY = 1 << 8  # 共鸣效率
HATK = 1 << 10  # 重击
SATK = 1 << 11  # 共鸣技能
TWO_CRIT = CRIT | CRIT_DMG  # 双暴
DCRIT_ATK = TWO_CRIT | ATK  # 双暴+大攻击
VALID6 = DCRIT_ATK | ATK_FIXED | HATK | ENERGY  # 双暴+大攻击+小攻击+重击+共效
VALID7 = VALID6 | SATK  # 双暴+大攻击+小攻击+重击+共效+共鸣技能
VALID5 = DCRIT_ATK | ATK_FIXED | SATK
VALID4 = DCRIT_ATK | SATK

# # 千分概率 probabilities
# PROB = [
#     73,  # 0暴击
#     64,  # 1暴击伤害
#     ################
#     72,  # 2攻击
#     75,  # 3防御
#     79,  # 4生命
#     ################
#     74,  # 5攻击固定值
#     83,  # 6防御固定值
#     83,  # 7生命固定值
#     ################
#     75,  # 8共鸣效率
#     85,  # 9普攻
#     75,  # 10重击
#     81,  # 11共鸣技能
#     81,  # 12共鸣解放
#     ################
#     0,  # 空，仅占位
# ]
#
# # 词条分布映射
# DIST = [0] * 1000
#
# print(sum(PROB))
# if sum(PROB) != 1000:
#     print("sum(PROB):", sum(PROB))
#     raise ValueError("千分概率之和必须为1000")
#
# cnt = 0
# for i, v in enumerate(PROB):
#     for j in range(cnt, cnt + v):
#         DIST[j] = i
#     cnt += v
#
# print(PROB)
# print()

# 声骸从 x 级升到 y 级需要多少声骸经验
EXP = defaultdict(lambda: defaultdict(int))
EXP[1][5] = 4500
EXP[1][10] = 16500
EXP[1][15] = 40000
EXP[1][20] = 79500
EXP[1][25] = 143000
# EXP[1][5] = 4500
EXP[5][10] = 12000
EXP[10][15] = 23500
EXP[15][20] = 39500
EXP[20][25] = 63500
EXP[10][20] = 63000

# 调谐器回收率
TUNER_RECYCLING_RATE = 0.3

# 密音筒声骸经验
EXP_GOLD = 5000
EXP_PURPLE = 2000
EXP_BLUE = 1000
EXP_GREEN = 500

# 声骸经验回收率
EXP_RETURN = defaultdict(int)
EXP_RETURN[5] = EXP_PURPLE * 1 + EXP_BLUE * 1  # = 3,000
EXP_RETURN[10] = EXP_GOLD * 2 + EXP_PURPLE * 1  # = 12,000
EXP_RETURN[15] = EXP_GOLD * 6  # = 30,000
EXP_RETURN[20] = EXP_GOLD * 11 + EXP_PURPLE * 2 + EXP_GREEN * 1  # = 5,9500
EXP_RETURN[25] = EXP_GOLD * 21 + EXP_BLUE * 1 + EXP_GREEN * 1  # = 10,6500
# 5级回收率  = 3000 / 4500 = 0.667
# 10级回收率 = 12000 / 16500 = 0.727
# 15级回收率 = 30000 / 40000 = 0.750
# 20级回收率 = 59500 / 79500 = 0.748
# 25级回收率 = 106500 / 143000 = 0.745

# 每打一次索拉等级 8 的无音区，调谐器跟金密音筒（声骸经验）的比值
TUNER_EXP_PRODUCE_RATIO = 20 / (24000 / EXP_GOLD)  # 4.17
