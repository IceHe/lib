from data import (
    EXP,
    EXP_GOLD,
    TWO_CRIT,
    EXP_RETURN,
    TUNER_RECYCLING_RATE,
)
from util import (
    count_bits,
    upgrade_14,
    upgrade_23,
    upgrade_32,
    upgrade_41,
    upgrade_all5,
)

print_detail = False

# 返回结果：双暴数量极其出现次数，还有累计消耗调谐器数量、累计开词条数量、消耗声骸数量

# 声明 python 数据类型


def upgrade_test(echo_limit: int, upgrade: callable) -> dict:
    global TUNER_RECYCLING_RATE, TWO_CRIT, EXP_RETURN

    exp_consumed = 0
    word_total = 0
    tuner_total = 0
    echo_total = 0
    double_crit_total = 0

    while echo_total < echo_limit:
        bitmap = upgrade()
        # word_count = bitmap.bit_count()
        word_count = count_bits(bitmap)

        exp_consumed += EXP[1][word_count * 5]

        tuner_total += word_count * 10
        word_total += word_count
        echo_total += 1

        if (bitmap & TWO_CRIT) == TWO_CRIT:
            double_crit_total += 1
        else:
            tuner_total -= word_count * 3

    if print_detail:
        print("累计开词条:", word_total)
        print("累计直接消耗调谐器:", word_total * 10)
        print("累计实际消耗调谐器:", tuner_total)
        print("累计消耗声骸经验:", exp_consumed)
        print("消耗胚子:", echo_total)
        print("双暴声骸:", double_crit_total)
        print()

    return {
        "double_crit_total": double_crit_total,
        "exp_consumed": exp_consumed,
        "tuner_total": tuner_total,
        "word_total": word_total,
        "echo_total": echo_total,
    }


def upgrade_stats(loop_count: int, echo_limit: int, upgrade: callable) -> dict:

    double_crit_total = 0
    exp_consumed = 0
    word_total = 0
    echo_total = 0
    tuner_total = 0
    for _ in range(loop_count):
        resp = upgrade_test(echo_limit, upgrade)
        double_crit_total += resp["double_crit_total"]
        exp_consumed += resp["exp_consumed"]
        word_total += resp["word_total"]
        echo_total += resp["echo_total"]
        tuner_total += resp["tuner_total"]

    # double_crit_per_loop = double_crit_total / loop_count
    # print(f"出货数量\t {double_crit_per_loop:.2f}")
    # print()

    # # print(f"开词条数 {word_total}")
    # print(f"累计消耗调谐器\t\t {word_total * 10 // loop_count:d}")
    # # print(f"累计消耗声骸经验\t {exp_consumed / loop_count:.2f}")
    # print(f"累计消耗金密音筒\t {exp_consumed / EXP_GOLD / loop_count:.1f}")
    # print(f"累计消耗胚子\t\t {echo_total / loop_count:.1f}")
    # print(f"平均每次出货直接消耗调谐器\t {word_total * 10 / double_crit_total:.1f}")
    print(f"平均每次出货消耗调谐器\t {tuner_total / double_crit_total:.1f}")
    print(f"平均每次出货消耗金筒\t {exp_consumed / double_crit_total / EXP_GOLD:.1f}")
    print(f"平均每次出货消耗胚子\t {echo_total / double_crit_total:.1f}")
    print()


if __name__ == "__main__":
    loop_count = 1
    echo_limit = 1000000

    print("目标：暴击 + 暴击伤害\n\n")
    # print(f"每种方法的模拟次数\t{loop_count:,}")
    print(f"每种方法的开声骸个数\t{echo_limit:,}")
    print()

    print("=======================================================")
    print("方法5：一次开 5 个词条\n")
    upgrade_stats(loop_count, echo_limit, upgrade_all5)

    print("=======================================================")
    print("方法41：先开 4 个词条，如果有至少 1 个目标词条，再开 1 个词条\n")
    upgrade_stats(loop_count, echo_limit, upgrade_41)

    print("=======================================================")
    print("方法14：先开 1 个词条，如果有至少 1 个目标词条，再开 4 个词条\n")
    upgrade_stats(loop_count, echo_limit, upgrade_14)

    print("=======================================================")
    print("方法23：先开 2 个词条，如果有至少 1 个目标词条，再开 3 个词条\n")
    upgrade_stats(loop_count, echo_limit, upgrade_23)

    print("=======================================================")
    print("方法32：先开 3 个词条，如果有至少 1 个目标词条，再开 2 个词条\n")
    upgrade_stats(loop_count, echo_limit, upgrade_32)

    # print('目标：双暴+大攻击')
    # print("先开2个词条，再开1个词条；如果前两个词条没有双暴但大攻击，再开1个词条")
    # upgrade_stats(loop_count, upgrade_23or212)
