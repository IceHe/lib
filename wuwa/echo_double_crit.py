from collections import defaultdict

from data import (
    EXP,
    EXP_GOLD,
    TUNER_EXP_PRODUCE_RATIO,
    TWO_CRIT,
    EXP_RETURN,
    TUNER_RECYCLING_RATE,
)
from util import (
    upgrade_14,
    upgrade_23,
    upgrade_32,
    upgrade_41,
    upgrade_all5,
)

print_detail = False

# 返回结果：双暴数量极其出现次数，还有累计消耗调谐器数量、累计开词条数量、消耗声骸数量

# 声明 python 数据类型


def upgrade_test(tuner_count: int, exp_total: int, upgrade: callable) -> dict:
    global TUNER_RECYCLING_RATE, TWO_CRIT, EXP_RETURN

    if print_detail:
        print(f"初始调谐器数量 {tuner_count:,}")
        print(f"初始声骸经验 {exp_total:,}")
        print(f"初始金密音筒 {exp_total // EXP_GOLD:,d}")

    exp_consumed = 0
    word_total = 0
    echo_total = 0
    double_crit_total = 0

    while True:
        if tuner_count < 50:
            break
        if exp_total < EXP[1][25]:
            break

        bitmap = upgrade()
        word_count = bitmap.bit_count()

        tuner_count -= word_count * 10
        exp_total -= EXP[1][word_count * 5]
        exp_consumed += EXP[1][word_count * 5]

        word_total += word_count
        echo_total += 1

        if (bitmap & TWO_CRIT) == TWO_CRIT:
            double_crit_total += 1
        else:
            tuner_count += word_count * 10 * TUNER_RECYCLING_RATE
            exp_total += EXP_RETURN[word_count * 5]

    if print_detail:
        print("剩余调谐器:", int(tuner_count))
        print("剩余声骸经验:", int(exp_total))
        print("累计开词条:", word_total)
        print("累计消耗调谐器:", word_total * 10)
        print("累计消耗声骸经验:", exp_consumed)
        print("消耗胚子:", echo_total)
        print("双暴声骸:", double_crit_total)
        print()

    return {
        "double_crit_total": double_crit_total,
        "tuner_rest": tuner_count,
        "exp_rest": exp_total,
        "exp_consumed": exp_consumed,
        "word_total": word_total,
        "echo_total": echo_total,
    }


def upgrade_stats(
    loop_count: int, tuner_count: int, exp_total: int, upgrade: callable
) -> dict:
    double_crit_dist = defaultdict(int)

    double_crit_total = 0
    tuner_rest = 0
    exp_rest = 0
    exp_consumed = 0
    word_total = 0
    echo_total = 0
    for _ in range(loop_count):
        resp = upgrade_test(tuner_count, exp_total, upgrade)
        double_crit_dist[resp["double_crit_total"]] += 1
        double_crit_total += resp["double_crit_total"]
        tuner_rest += resp["tuner_rest"]
        exp_rest += resp["exp_rest"]
        exp_consumed += resp["exp_consumed"]
        word_total += resp["word_total"]
        echo_total += resp["echo_total"]

    double_crit_per_loop = double_crit_total / loop_count

    # print(f"初始调谐器数量\t\t{tuner_count:,}")
    # print(f"初始声骸经验 {exp_total:,}")
    # print(f"对应金密音筒数量\t{exp_total // EXP_GOLD:,}")
    print(f"出货数量\t {double_crit_per_loop:.2f}")
    print()

    # print(f"开词条数 {word_total}")
    print(f"累计消耗调谐器\t\t {word_total * 10 // loop_count:d}")
    # print(f"累计消耗声骸经验\t {exp_consumed / loop_count:.2f}")
    print(f"累计消耗金密音筒\t {exp_consumed / EXP_GOLD / loop_count:.1f}")
    print(f"累计消耗胚子\t\t {echo_total / loop_count:.1f}")
    print(f"平均每次出货消耗调谐器\t {word_total * 10 / double_crit_total:.1f}")
    print(f"平均每次出货消耗金筒\t {exp_consumed / double_crit_total / EXP_GOLD:.1f}")
    print(f"平均每次出货消耗胚子\t {echo_total / double_crit_total:.1f}")
    print()

    tuner_reduced_per_loop = tuner_count - tuner_rest / loop_count
    exp_reduced_per_loop = (exp_total - exp_rest / loop_count) / EXP_GOLD
    tuner_exp_consume_ratio = tuner_reduced_per_loop / exp_reduced_per_loop
    print(f"每趟减少调谐器库存\t\t {tuner_reduced_per_loop:.1f}")
    print(f"每趟减少金密音筒库存\t\t {exp_reduced_per_loop:.1f}")
    print(
        f"平均每次出货减少调谐器库存\t {tuner_reduced_per_loop / double_crit_per_loop:.1f}"
    )
    print(f"平均每次出货减少金筒库存\t {exp_reduced_per_loop:.1f}")
    print()

    print("双暴声骸数量，\t次数，\t\t概率")
    for i in range(0, max(double_crit_dist.keys()) + 1):
        # 按百分位%格式打印概率
        v = double_crit_dist[i]
        print(f"{i}，\t\t{v}，\t\t{v / loop_count:.2%}")
    print()

    print(
        f"平均每次出货消耗的调谐器跟声骸经验（换算为金密音筒）的比值\t{tuner_exp_consume_ratio:.2f}"
    )
    print(
        f"平均每次打索拉等级8无音区产出的调谐器跟声骸经验的比值\t\t{TUNER_EXP_PRODUCE_RATIO:.2f}"
    )
    if tuner_exp_consume_ratio > TUNER_EXP_PRODUCE_RATIO:
        print(
            f"调谐器的消耗比金密音筒大，调谐器越用越少，声骸经验越剩越多\t{tuner_exp_consume_ratio:.2f} > {TUNER_EXP_PRODUCE_RATIO:.2f}"
        )
    else:
        print(
            f"调谐器的消耗比金密音筒小，调谐器越用越多，声骸经验紧缺\t\t{tuner_exp_consume_ratio:.2f} < {TUNER_EXP_PRODUCE_RATIO:.2f}"
        )
    print()

    return double_crit_dist


if __name__ == "__main__":
    loop_count = 100000
    # tuner_count = 500
    # exp_total = 5000 * 120  # = 600000
    tuner_count = 500 * 2
    exp_total = 5000 * 240  # = 1200000

    print("目标：双暴\n")
    print(f"初始调谐器数量\t\t{tuner_count:,}")
    print(f"初始声骸经验\t\t{exp_total:,}")
    print(f"对应金密音筒数量\t{exp_total // EXP_GOLD:,}")
    # print(f"\n每种方法的模拟次数\t{loop_count:,}")
    print()

    print("=======================================================")
    print("方法：一次开 5 个词条\n")
    upgrade_stats(loop_count, tuner_count, exp_total, upgrade_all5)

    print("=======================================================")
    print("方法：先开 4 个词条，再开 1 个词条\n")
    upgrade_stats(loop_count, tuner_count, exp_total, upgrade_41)

    print("=======================================================")
    print("方法：先开 1 个词条，再开 4 个词条\n")
    upgrade_stats(loop_count, tuner_count, exp_total, upgrade_14)

    print("=======================================================")
    print("方法：先开 2 个词条，再开 3 个词条\n")
    upgrade_stats(loop_count, tuner_count, exp_total, upgrade_23)

    print("=======================================================")
    print("方法：先开 3 个词条，再开 2 个词条\n")
    upgrade_stats(loop_count, tuner_count, exp_total, upgrade_32)

    # print('目标：双暴+大攻击')
    # print("先开2个词条，再开1个词条；如果前两个词条没有双暴但大攻击，再开1个词条")
    # upgrade_stats(loop_count, tuner_count, exp_total, upgrade_23or212)
