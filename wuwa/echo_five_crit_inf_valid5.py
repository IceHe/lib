from data import (
    EXP,
    EXP_GOLD,
    TWO_CRIT,
    EXP_RETURN,
    VALID5,
)
from util import (
    count_bits,
    upgrade_11111,
    upgrade_all5,
)

print_detail = False

# 返回结果：双暴数量极其出现次数，还有累计消耗调谐器数量、累计开词条数量、消耗声骸数量

# 声明 python 数据类型


def upgrade_test(echo_limit: int, upgrade: callable) -> dict:
    global TWO_CRIT, EXP_RETURN

    target_total = 0
    exp_consumed = 0
    tuner_total = 0
    word_total = 0
    echo_total = 0

    while echo_total < echo_limit:
        bitmap = upgrade()
        # word_count = bitmap.bit_count()
        word_count = count_bits(bitmap)

        exp_consumed += EXP[1][word_count * 5]
        tuner_total += word_count * 10
        word_total += word_count
        echo_total += 1

        if (bitmap & TWO_CRIT) == TWO_CRIT and count_bits(bitmap & VALID5) == 5:
            target_total += 1
        else:
            # 其他情况，回收调谐器和经验
            exp_consumed -= EXP_RETURN[word_count * 5]
            tuner_total -= word_count * 3
            word_count = word_count

    if print_detail:
        print("累计开词条:", word_total)
        print("累计直接消耗调谐器:", word_total * 10)
        print("累计消耗调谐器:", tuner_total)
        print("累计消耗声骸经验:", exp_consumed)
        print("消耗胚子:", echo_total)
        print("双暴声骸:", target_total)
        print()

    return {
        "target_total": target_total,
        "exp_consumed": exp_consumed,
        "tuner_total": tuner_total,
        "word_total": word_total,
        "echo_total": echo_total,
    }


def upgrade_stats(loop_count: int, echo_limit: int, upgrade: callable) -> dict:

    target_total = 0
    exp_consumed = 0
    tuner_total = 0
    word_total = 0
    echo_total = 0
    for _ in range(loop_count):
        resp = upgrade_test(echo_limit, upgrade)
        target_total += resp["target_total"]
        exp_consumed += resp["exp_consumed"]
        tuner_total += resp["tuner_total"]
        word_total += resp["word_total"]
        echo_total += resp["echo_total"]

    # double_crit_per_loop = target_total / loop_count
    # print(f"出货数量\t {double_crit_per_loop:.2f}")
    # print()

    # # print(f"开词条数 {word_total}")
    # print(f"累计消耗调谐器\t\t {word_total * 10 // loop_count:d}")
    # # print(f"累计消耗声骸经验\t {exp_consumed / loop_count:.2f}")
    # print(f"累计消耗金密音筒\t {exp_consumed / EXP_GOLD / loop_count:.1f}")
    # print(f"累计消耗胚子\t\t {echo_total / loop_count:.1f}")
    # print(f"平均每次出货消耗调谐器\t {word_total * 10 / target_total:.1f}")
    print(f"平均每次出货消耗调谐器\t {tuner_total / target_total:.1f}")
    print(f"平均每次出货消耗金筒\t {exp_consumed / target_total / EXP_GOLD:.1f}")
    print(f"平均每次出货消耗胚子\t {echo_total / target_total:.1f}")
    print()


if __name__ == "__main__":
    loop_count = 10
    echo_limit = 1000000
    # tuner_count = 500
    # exp_total = 5000 * 120  # = 600000

    print("\n目标：5 有效词条 暴击 + 暴击伤害 + 攻击百分比 + 攻击固定值 + 共鸣技能")
    print("前提：词条出率均等，不满足目标要求的声骸都会直接回收声骸经验和调谐器\n\n")
    print(f"每种方法开出 {echo_limit:,} 个五有效声骸为止")
    print(f"重复 {loop_count:,} 次这个过程")
    print()

    print("=======================================================")
    print("方法5：一次开 5 个词条\n")
    upgrade_stats(loop_count, echo_limit, upgrade_all5)

    print("=======================================================")
    print("方法11111：逐条开")
    upgrade_stats(loop_count, echo_limit, upgrade_11111)
