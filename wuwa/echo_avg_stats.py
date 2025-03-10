# 特定的攻击类型也算有效
from data import ATK, HATK, WORD
from util import have_crit, tune_avg


# 除了双暴和攻击百分比，重击也视为一种有价值的伤害加成类型
def upgrade_23or212b() -> int:
    bitmap = 0

    # 先开2个词条
    bitmap |= 1 << tune_avg(bitmap)
    bitmap |= 1 << tune_avg(bitmap)

    # 如果没双暴，但有大攻击或重击，再开一个词条
    if not have_crit(bitmap) and bool(bitmap & (ATK | HATK)):
        bitmap |= 1 << tune_avg(bitmap)
    if not have_crit(bitmap):
        return bitmap

    # 再开剩下的词条
    for _ in range(5 - bitmap.bit_count()):
        bitmap |= 1 << tune_avg(bitmap)
    return bitmap


def echo_stats():
    cnt = [
        0,  # 0暴击
        0,  # 1暴击伤害
        ################
        0,  # 2攻击
        0,  # 3防御
        0,  # 4生命
        ################
        0,  # 5攻击固定
        0,  # 6防御固定
        0,  # 7生命固定
        ################
        0,  # 8效率
        0,  # 9普攻
        0,  # 10重击
        0,  # 11技能
        0,  # 12大招
        ################
    ]
    loop_count = 1000000
    word_total = 0
    for _ in range(loop_count):
        bitmap = upgrade_23or212b()
        for i in range(13):
            if bitmap & (1 << i):
                cnt[i] += 1
        word_total += bitmap.bit_count()
    # 打印千分概率
    for i in range(13):
        print(f"{cnt[i] / word_total * 100:.2f}% {WORD[i]}")


if __name__ == "__main__":
    for _ in range(10):
        print(f"第{_ + 1}次模拟：")
        echo_stats()
        print()
