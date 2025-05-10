# 返回词条下标
import random
from data import ATK, DCRIT_ATK, TWO_CRIT, VALID7

def count_bits(n: int):
    count = 0
    while n:
        count += 1
        n &= n - 1
    return count

# # 开一个词条 (带权重)
# def tune(bitmap: int) -> int:
#     # if bitmap.bit_count() >= 5:
#     if count_bits(bitmap) >= 5:
#         raise ValueError("已开词条数量>=5")
#     i = DIST[random.randint(0, 999)]
#     if bitmap & (1 << i):
#         return tune(bitmap)  # 已出现相同的词条，重新roll
#     return i


# 开一个词条，平均概率
def tune_avg(bitmap: int) -> int:
    # if bitmap.bit_count() >= 5:
    if count_bits(bitmap) >= 5:
        raise ValueError("已开词条数量>=5")
    i = random.randint(0, 12)
    if bitmap & (1 << i):
        return tune_avg(bitmap)  # 已出现相同的词条，重新roll
    return i


# 直接用平均概率
tune = tune_avg


# 有效词条数量
def valid_count(bitmap: int, valid_bitmap: int) -> int:
    # return (bitmap & valid_bitmap).bit_count()
    return count_bits(bitmap & valid_bitmap)


# 是否有暴击词条
def have_crit(bitmap: int) -> bool:
    return bool(bitmap & TWO_CRIT)


# 强化一个声骸，一次性开5个词条，返回包含的词条
def upgrade_all5() -> int:
    bitmap = 0
    for _ in range(5):
        bitmap |= 1 << tune(bitmap)
    # global TWO_CRIT
    # if bitmap & double_crit == double_crit:
    #     # 打印二进制位，宽度为13，二进制位倒转
    #     print('double crit:', f'{bitmap:013b}'[::-1])
    return bitmap


def upgrade_14() -> int:
    bitmap = 0
    bitmap |= 1 << tune(bitmap)
    if have_crit(bitmap):
        for _ in range(4):
            bitmap |= 1 << tune(bitmap)
    return bitmap


def upgrade_41() -> int:
    bitmap = 0
    for _ in range(4):
        bitmap |= 1 << tune(bitmap)
    if have_crit(bitmap):
        bitmap |= 1 << tune(bitmap)
    return bitmap


def upgrade_23() -> int:
    bitmap = 0
    # 先开2个词条
    bitmap |= 1 << tune(bitmap)
    bitmap |= 1 << tune(bitmap)
    if have_crit(bitmap):
        for _ in range(3):
            bitmap |= 1 << tune(bitmap)
    return bitmap


def upgrade_32() -> int:
    bitmap = 0
    for _ in range(3):
        bitmap |= 1 << tune(bitmap)
    if have_crit(bitmap):
        bitmap |= 1 << tune(bitmap)
        bitmap |= 1 << tune(bitmap)
    return bitmap


# 目标：双暴+攻击力百分比
def upgrade_41a() -> int:
    bitmap = 0

    # 先开1个词条
    bitmap |= 1 << tune(bitmap)
    bitmap |= 1 << tune(bitmap)
    bitmap |= 1 << tune(bitmap)
    bitmap |= 1 << tune(bitmap)

    # 如果没双暴或大攻击，再开1个词条
    if valid_count(bitmap, DCRIT_ATK) < 2:
        return bitmap

    # 再开剩下的词条
    bitmap |= 1 << tune(bitmap)
    return bitmap

# 目标：双暴+大小攻击+共效+重击
def upgrade_41b() -> int:
    bitmap = 0

    # 先开1个词条
    bitmap |= 1 << tune(bitmap)
    bitmap |= 1 << tune(bitmap)
    bitmap |= 1 << tune(bitmap)
    bitmap |= 1 << tune(bitmap)

    # 如果没双暴或大攻击，再开1个词条
    if valid_count(bitmap, TWO_CRIT) < 1 or valid_count(bitmap, VALID7) < 3:
        return bitmap

    # 再开剩下的词条
    bitmap |= 1 << tune(bitmap)
    return bitmap


def upgrade_311a() -> int:
    bitmap = 0

    # 先开1个词条
    bitmap |= 1 << tune(bitmap)
    bitmap |= 1 << tune(bitmap)
    bitmap |= 1 << tune(bitmap)
    if valid_count(bitmap, DCRIT_ATK) < 1:
        return bitmap

    # 再开1个词条
    bitmap |= 1 << tune(bitmap)
    if valid_count(bitmap, DCRIT_ATK) < 2:
        return bitmap

    # 再开剩下的词条
    bitmap |= 1 << tune(bitmap)
    return bitmap

def upgrade_311b() -> int:
    bitmap = 0

    # 先开1个词条
    bitmap |= 1 << tune(bitmap)
    bitmap |= 1 << tune(bitmap)
    bitmap |= 1 << tune(bitmap)
    if valid_count(bitmap, VALID7) < 2:
        return bitmap

    # 再开1个词条
    bitmap |= 1 << tune(bitmap)
    if valid_count(bitmap, TWO_CRIT) < 1 or valid_count(bitmap, VALID7) < 3:
        return bitmap

    # 再开剩下的词条
    bitmap |= 1 << tune(bitmap)
    return bitmap


def upgrade_131() -> int:
    bitmap = 0

    # 先开1个词条
    bitmap |= 1 << tune(bitmap)
    if valid_count(bitmap, DCRIT_ATK) < 1:
        return bitmap

    # 再开3个词条
    bitmap |= 1 << tune(bitmap)
    bitmap |= 1 << tune(bitmap)
    bitmap |= 1 << tune(bitmap)
    if valid_count(bitmap, DCRIT_ATK) < 2:
        return bitmap

    # 再开剩下的词条
    bitmap |= 1 << tune(bitmap)
    return bitmap

# def upgrade_131b() -> int:
#     bitmap = 0

#     # 先开1个词条
#     bitmap |= 1 << tune(bitmap)
#     if valid_count(bitmap, VALID7) < 1:
#         return bitmap

#     # 再开3个词条
#     bitmap |= 1 << tune(bitmap)
#     bitmap |= 1 << tune(bitmap)
#     bitmap |= 1 << tune(bitmap)
#     if valid_count(bitmap, TWO_CRIT) < 1 or valid_count(bitmap, VALID7) < 3:
#         return bitmap

#     # 再开剩下的词条
#     bitmap |= 1 << tune(bitmap)
#     return bitmap


def upgrade_221a() -> int:
    bitmap = 0

    # 先开2个词条
    bitmap |= 1 << tune(bitmap)
    bitmap |= 1 << tune(bitmap)

    if valid_count(bitmap, DCRIT_ATK) < 1:
        return bitmap

    # 如果有双暴或大攻击，再开2个词条
    bitmap |= 1 << tune(bitmap)
    bitmap |= 1 << tune(bitmap)
    if valid_count(bitmap, DCRIT_ATK) < 2:
        return bitmap

    # 再开剩下的词条
    bitmap |= 1 << tune(bitmap)
    return bitmap

def upgrade_221b() -> int:
    bitmap = 0

    # 先开2个词条
    bitmap |= 1 << tune(bitmap)
    bitmap |= 1 << tune(bitmap)
    if valid_count(bitmap, VALID7) < 1:
        return bitmap

    # 如果有双暴或大攻击，再开2个词条
    bitmap |= 1 << tune(bitmap)
    bitmap |= 1 << tune(bitmap)
    if valid_count(bitmap, TWO_CRIT) < 1 or valid_count(bitmap, VALID7) < 3:
        return bitmap

    # 再开剩下的词条
    bitmap |= 1 << tune(bitmap)
    return bitmap

def upgrade_212a() -> int:
    bitmap = 0

    # 先开2个词条
    bitmap |= 1 << tune(bitmap)
    bitmap |= 1 << tune(bitmap)

    if valid_count(bitmap, DCRIT_ATK) < 1:
        return bitmap

    # 如果有双暴或大攻击，再开1个词条
    bitmap |= 1 << tune(bitmap)
    if valid_count(bitmap, DCRIT_ATK) < 2:
        return bitmap

    # 再开剩下的词条
    bitmap |= 1 << tune(bitmap)
    bitmap |= 1 << tune(bitmap)
    return bitmap


def upgrade_23or212a() -> int:
    bitmap = 0

    # 先开2个词条
    bitmap |= 1 << tune(bitmap)
    bitmap |= 1 << tune(bitmap)

    # 如果没双暴，但有大攻击，再开一个词条
    if not have_crit(bitmap) and bool(bitmap & ATK):
        bitmap |= 1 << tune(bitmap)
    if not have_crit(bitmap):
        return bitmap

    # 再开剩下的词条
    # for _ in range(5 - bitmap.bit_count()):
    for _ in range(5 - count_bits(bitmap)):
        bitmap |= 1 << tune(bitmap)
    return bitmap

def upgrade_2111() -> int:
    bitmap = 0

    # 先开2个词条
    bitmap |= 1 << tune(bitmap)
    bitmap |= 1 << tune(bitmap)
    if valid_count(bitmap, VALID7) < 1:
        return bitmap

    bitmap |= 1 << tune(bitmap)
    if valid_count(bitmap, VALID7) < 2:
        return bitmap

    bitmap |= 1 << tune(bitmap)
    if valid_count(bitmap, TWO_CRIT) < 1 or valid_count(bitmap, VALID7) < 3:
        return bitmap

    # 再开剩下的词条
    bitmap |= 1 << tune(bitmap)
    return bitmap

def upgrade_11111() -> int:
    bitmap = 0

    # 先开2个词条
    bitmap |= 1 << tune(bitmap)
    if valid_count(bitmap, VALID7) != 1:
        return bitmap

    bitmap |= 1 << tune(bitmap)
    if valid_count(bitmap, VALID7) != 2:
        return bitmap

    bitmap |= 1 << tune(bitmap)
    if valid_count(bitmap, VALID7) != 3:
        return bitmap

    bitmap |= 1 << tune(bitmap)
    if valid_count(bitmap, VALID7) != 4 or valid_count(bitmap, TWO_CRIT) < 1:
        return bitmap

    # 再开剩下的词条
    bitmap |= 1 << tune(bitmap)
    return bitmap
