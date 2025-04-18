from collections import defaultdict

from data import (
    CRIT,
    DCRIT_ATK,
    EXP,
    EXP_GOLD,
    TUNER_EXP_PRODUCE_RATIO,
    TWO_CRIT,
    EXP_RETURN,
    TUNER_RECYCLING_RATE,
    VALID6,
)
from util import (
    count_bits,
    upgrade_131,
    upgrade_14,
    upgrade_2111,
    upgrade_212a,
    upgrade_221a,
    upgrade_221b,
    upgrade_23,
    upgrade_23or212a,
    upgrade_311a,
    upgrade_311b,
    upgrade_32,
    upgrade_41,
    upgrade_41a,
    upgrade_41b,
    upgrade_all5,
)

print_detail = False

# 返回结果：双暴数量极其出现次数，还有累计消耗调谐器数量、累计开词条数量、消耗声骸数量

# 声明 python 数据类型


def upgrade_test(echo_limit: int, upgrade: callable) -> dict:
    global TUNER_RECYCLING_RATE, TWO_CRIT, EXP_RETURN

    exp_consumed = 0
    word_total = 0
    echo_total = 0
    target_total = 0

    while echo_total < echo_limit:
        bitmap = upgrade()
        # word_count = bitmap.bit_count()
        word_count = count_bits(bitmap)

        exp_consumed += EXP[1][word_count * 5]

        word_total += word_count
        echo_total += 1

        if (bitmap & TWO_CRIT) == TWO_CRIT and count_bits(bitmap & VALID6) >= 4:
            target_total += 1

    if print_detail:
        print("累计开词条:", word_total)
        print("累计消耗调谐器:", word_total * 10)
        print("累计消耗声骸经验:", exp_consumed)
        print("消耗胚子:", echo_total)
        print("双暴声骸:", target_total)
        print()

    return {
        "double_crit_total": target_total,
        "exp_consumed": exp_consumed,
        "word_total": word_total,
        "echo_total": echo_total,
    }


def upgrade_stats(
    loop_count: int, echo_limit: int, upgrade: callable
) -> dict:

    double_crit_total = 0
    exp_consumed = 0
    word_total = 0
    echo_total = 0
    for _ in range(loop_count):
        resp = upgrade_test(echo_limit, upgrade)
        double_crit_total += resp["double_crit_total"]
        exp_consumed += resp["exp_consumed"]
        word_total += resp["word_total"]
        echo_total += resp["echo_total"]

    # double_crit_per_loop = double_crit_total / loop_count
    # print(f"出货数量\t {double_crit_per_loop:.2f}")
    # print()

    # # print(f"开词条数 {word_total}")
    # print(f"累计消耗调谐器\t\t {word_total * 10 // loop_count:d}")
    # # print(f"累计消耗声骸经验\t {exp_consumed / loop_count:.2f}")
    # print(f"累计消耗金密音筒\t {exp_consumed / EXP_GOLD / loop_count:.1f}")
    # print(f"累计消耗胚子\t\t {echo_total / loop_count:.1f}")
    print(f"平均每次出货消耗调谐器\t {word_total * 10 / double_crit_total:.1f}")
    print(f"平均每次出货消耗金筒\t {exp_consumed / double_crit_total / EXP_GOLD:.1f}")
    print(f"平均每次出货消耗胚子\t {echo_total / double_crit_total:.1f}")
    print()


if __name__ == "__main__":
    loop_count = 1
    echo_limit = 1000000
    # tuner_count = 500
    # exp_total = 5000 * 120  # = 600000

    print("目标：4 有效词条 暴击 + 暴击伤害 \n +（攻击百分比、攻击固定值、重击伤害加成、共鸣效率) 四选二\n\n")
    # print(f"每种方法的模拟次数\t{loop_count:,}")
    print(f"每种方法的开声骸个数\t{echo_limit:,}")
    print()

    print("=======================================================")
    print("方法5：一次开 5 个词条\n")
    upgrade_stats(loop_count, echo_limit, upgrade_all5)

    print("=======================================================")
    print("方法41：先开 4 个词条，如果有至少 3 个目标词条，再开 1 个词条\n")
    upgrade_stats(loop_count, echo_limit, upgrade_41b)

    print("=======================================================")
    print("方法311：先开 3 个词条，如果有至少 2 个目标词条，开 1 个词条")
    print("           如果有至少 3 个目标词条，再开最后 1 个词条\n")
    upgrade_stats(loop_count, echo_limit, upgrade_311b)

    # print("=======================================================")
    # print("方法131：先开 1 个词条，如果有至少 1 个目标词条，再开 3 个词条")
    # print("           如果有至少 2 个目标词条，再开最后 1 个词条\n")
    # upgrade_stats(loop_count, echo_limit, upgrade_131b)

    print("=======================================================")
    print("方法221：先开 2 个词条，\n如果有至少 1 个目标词条，再开 1 个词条")
    print("           如果有至少 2 个目标词条，再开 1 个词条")
    print("           如果有至少 3 个目标词条，再开最后 1 个词条\n")
    upgrade_stats(loop_count, echo_limit, upgrade_221b)

    print("=======================================================")
    print("方法2111：先开 2 个词条，如果有至少 1 个目标词条，再开 1 个词条")
    print("           如果有至少 2 个目标词条，再开最后 2 个词条\n")
    upgrade_stats(loop_count, echo_limit, upgrade_2111)
