import random
from collections import defaultdict

# 13种词条的千分概率
probabilities = [
    73,  # 暴击
    60,  # 暴击伤害
    74,  # 攻击%
    70,  # 防御%
    88,  # 生命%
    76,  # 攻击固定+
    80,  # 防御固定+
    90,  # 生命固定+
    72,  # 效率%
    88,  # 普攻%
    69,  # 重击%
    77,  # 技能%
    83,  # 大招%
    0,  # 空，仅占位
]

double_crit = 0b11  # 双暴 bitmap

# 分布
dist = [0] * 1000

print(sum(probabilities))
if sum(probabilities) != 1000:
    raise ValueError("概率之和不为1000")

cnt = 0
for i, v in enumerate(probabilities):
    for j in range(cnt, cnt + v):
        dist[j] = i
    cnt += v

print(probabilities)
print()


# 返回词条下标
def roll(bitmap: int) -> int:
    i = dist[random.randint(0, 999)]
    if bitmap & (1 << i):
        return roll(bitmap)  # 已出现相同的词条，重新roll
    return i


# 强化一个声骸，一次性开5个词条，返回包含的词条
def upgrade_all5() -> int:
    global double_crit
    bitmap = 0
    for _ in range(5):
        bitmap |= 1 << roll(bitmap)
    # if bitmap & double_crit == double_crit:
    #     # 打印二进制位，宽度为13，二进制位倒转
    #     print('double crit:', f'{bitmap:013b}'[::-1])
    return bitmap


expr = defaultdict(lambda: defaultdict(int))
expr[1][5] = 4500
expr[1][10] = 16500
expr[1][15] = 40000
expr[1][20] = 79500
expr[1][25] = 143000
expr[5][10] = 12000
expr[10][15] = 23500
expr[15][20] = 39500
expr[20][25] = 63500
expr[10][20] = 63000


def test():
    # 调谐器回收率
    tunner_recycle_rate = 0.3
    # 声骸经验回收率
    expr_recycle_rate = 0.72

    tuner_count = 500
    expr_total = 600000  # = 5000 * 120
    print("初始调谐器数量:", tuner_count)
    print("初始声骸经验:", expr_total)

    word_total = 0
    echo_total = 0
    double_crit_total = 0

    while True:
        global double_crit

        if tuner_count < 50:
            break
        if expr_total < expr[1][25]:
            break

        bitmap = 0
        for _ in range(5):
            bitmap |= 1 << roll(bitmap)

        tuner_count -= 50
        expr_total -= expr[1][25]

        word_total += 5
        echo_total += 1
        if bitmap & double_crit == double_crit:
            double_crit_total += 1
        else:
            tuner_count += 50 * tunner_recycle_rate
            expr_total += expr[1][25] * expr_recycle_rate

    # print('剩余调谐器数量:', int(tuner_count))
    # print('剩余声骸经验:', int(expr_total))
    print("累计开孔:", word_total)
    print("累计消耗调谐器:", word_total * 10)
    print("消耗声骸数量:", echo_total)
    print("双暴声骸数量:", double_crit_total)
    print()

    return double_crit_total


if __name__ == "__main__":
    double_crit_dist = defaultdict(int)

    loop_count = 100000
    double_crit_total = 0
    for _ in range(loop_count):
        double_crit_count = test()
        double_crit_dist[double_crit_count] += 1
        double_crit_total += double_crit_count
    print("双暴声骸总数:", double_crit_total)
    print(
        "平均每消耗1000个打孔器多少个双暴声骸(含回收):", double_crit_total / loop_count
    )
    print()

    for i, v in double_crit_dist.items():
        # 按百分位%格式打印概率
        print("双暴声骸数量", i, "次数", v, "概率", v / loop_count * 100, "%")
