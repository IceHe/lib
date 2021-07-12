# CPU

> Show CPU info ( not a command )

References

- [Linux查看物理CPU个数、核数、逻辑CPU个数](https://www.cnblogs.com/emanlee/p/3587571.html)

```bash
# 总核数 = 物理CPU个数 * 每颗物理CPU的核数
# 总逻辑CPU数 = 物理CPU个数 * 每颗物理CPU的核数 * 超线程数

# 查看物理 CPU 个数
$ cat /proc/cpuinfo | grep "physical id" | sort | uniq | wc -l
2

# 查看每个物理 CPU 中 core 的个数 (即核数)
$ cat /proc/cpuinfo | grep "cpu cores" | uniq
cpu cores       : 32

# 查看逻辑 CPU 的个数
$ cat /proc/cpuinfo | grep "processor" | wc -l
128

# 通过以上信息可算出:
# CPU 超线程数 = 2

# 查看 CPU 信息（型号）
$ cat /proc/cpuinfo | grep name | cut -f2 -d: | uniq -c
    128  AMD EPYC 7502 32-Core Processor
```

---

```bash
# 查看内存信息
$ cat /proc/meminfo
cat /proc/meminfo
MemTotal:       528295604 kB
MemFree:        28842276 kB
MemAvailable:   184405152 kB
Buffers:            1328 kB
Cached:         153549120 kB
SwapCached:            0 kB
Active:         360526972 kB
Inactive:       121064384 kB
Active(anon):   327576660 kB
Inactive(anon):     4888 kB
Active(file):   32950312 kB
Inactive(file): 121059496 kB
Unevictable:           0 kB
Mlocked:               0 kB
SwapTotal:             0 kB
SwapFree:              0 kB
Dirty:            118008 kB
Writeback:             0 kB
AnonPages:      327949936 kB
Mapped:           756260 kB
Shmem:             21984 kB
Slab:           12609792 kB
SReclaimable:    4719312 kB
SUnreclaim:      7890480 kB
KernelStack:      681664 kB
PageTables:      1114600 kB
NFS_Unstable:          0 kB
Bounce:                0 kB
WritebackTmp:          0 kB
CommitLimit:    264147800 kB
Committed_AS:   504832664 kB
VmallocTotal:   34359738367 kB
VmallocUsed:           0 kB
VmallocChunk:          0 kB
Percpu:           835584 kB
HardwareCorrupted:     0 kB
AnonHugePages:    116736 kB
ShmemHugePages:        0 kB
ShmemPmdMapped:        0 kB
CmaTotal:              0 kB
CmaFree:               0 kB
HugePages_Total:       0
HugePages_Free:        0
HugePages_Rsvd:        0
HugePages_Surp:        0
Hugepagesize:       2048 kB
Hugetlb:               0 kB
DirectMap4k:     1267912 kB
DirectMap2M:    118132736 kB
DirectMap1G:    418381824 kB
```
