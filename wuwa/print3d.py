import matplotlib.pyplot as plt
import numpy as np
from mpl_toolkits.mplot3d import Axes3D

# 暴击率数据
crit_rates = [6.3, 6.9, 7.5, 8.1, 8.7, 9.3, 9.9, 10.5]
# 暴伤数据
crit_damages = [12.6, 13.8, 15.0, 16.2, 17.4, 18.6, 19.8, 21.0]
# 对应的值数据
values = np.array(
    [
        [50, 52, 37, 25, 19, 24, 6, 4],
        [47, 37, 57, 14, 14, 12, 6, 4],
        [49, 54, 66, 9, 21, 22, 9, 6],
        [18, 24, 24, 4, 4, 5, 0, 0],
        [20, 11, 15, 4, 8, 7, 3, 2],
        [17, 9, 15, 6, 7, 6, 2, 1],
        [7, 7, 7, 2, 4, 4, 2, 0],
        [4, 4, 9, 1, 1, 2, 0, 1],
    ]
)

# 创建图形
fig = plt.figure(figsize=(10, 8))
ax = fig.add_subplot(111, projection="3d")
# 生成网格数据
x, y = np.meshgrid(range(len(crit_damages)), range(len(crit_rates)))
x, y = x.flatten(), y.flatten()
z = values.flatten()
# 绘制三维柱状图
ax.bar3d(x, y, np.zeros_like(z), 0.8, 0.8, z, shade=True)
# 设置坐标轴标签
ax.set_xlabel("暴伤")
ax.set_ylabel("暴击率")
ax.set_zlabel("数值")
# 设置坐标轴刻度标签
ax.set_xticks(range(len(crit_damages)))
ax.set_xticklabels([f"{cd}%" for cd in crit_damages])
ax.set_yticks(range(len(crit_rates)))
ax.set_yticklabels([f"{cr}%" for cr in crit_rates])
# 显示图形
plt.show()
