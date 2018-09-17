# df

> display free disk space

## Options

- `-a` | `--all` include dummy file systems
- `-h` | `--human-readable` print sizes in human readable format (e.g., 1K 234M 2G)
- `-H` | `--si` likewise, but use powers of 1000 not 1024

## KiB & KB

In short

- `kilo-` = 1,000
- `kibi-` = 1,024 = kilo binary
- `mebi-` = 1,024 * 1024 = mega binary
- …

Format

- 10^3 means 10<sup>3</sup>
- ( 2^10 )^3 means (2<sup>10</sup>)<sup>3</sup>

Derivations

- kilo : ( 10^3 )^1
- mega : ( 10^3 )^2
- giga : ( 10^3 )^3
- tera : ( 10^3 )^4
- peta : ( 10^3 )^5
- exa : ( 10^3 )^6

**SI** prefixes

- 1 KB = 1,000 Byte = 10^3 Byte
- 1 MB = 1,000 KB = 10^3 KB
- 1 GB = 1,000 MB = 10^6 KB = 1,000,000 KB
- 1 TB = 1,000 GB = 10^9 KB = 1,000,000,000 KB
- …

**IEC** prefixes

- 1 KiB = 1,024 Byte = 2^10 Byte
- 1 MiB = 1,024 KiB = 2^20 KB
- 1 GiB = 1,024 MiB = 2^30 KB = 1,048,576 KiB
- 1 TiB = 1,024 GiB = 2^40 KB = 1,073,741,824 KiB
- …

References

- [What is the difference between a kilobyte and a kibibyte?](https://www.quora.com/What-is-the-difference-between-a-kilobyte-and-a-kibibyte) - Quaro
- [KB / KiB，MB / MiB，GB / GiB，… 的区别是什么？](https://www.zhihu.com/question/24601215) - 知乎
- [Definitions of the SI units: The binary prefixes](https://physics.nist.gov/cuu/Units/binary.html)

## Usage

Output in KB, GB, TB…

```bash
df -h
# output e.g.
Filesystem      Size   Used  Avail Capacity  iused               ifree %iused  Mounted on
/dev/disk1s1   466Gi  355Gi  109Gi    77%  3484707 9223372036851291100    0%   /
devfs          344Ki  344Ki    0Bi   100%     1191                   0  100%   /dev
/dev/disk1s4   466Gi  1.0Gi  109Gi     1%        2 9223372036854775805    0%   /private/var/vm
map -hosts       0Bi    0Bi    0Bi   100%        0                   0  100%   /net
map auto_home    0Bi    0Bi    0Bi   100%        0                   0  100%   /home
/dev/disk2s4   454Gi  128Gi  326Gi    29%      355          4294966924    0%   /Volumes/IceHe_何志远
```
Output in KiB, GiB, TiB…

```bash
df -H
# output e.g.
Filesystem     Size   Used  Avail Capacity  iused               ifree %iused  Mounted on
/dev/disk1s1   500G   381G   117G    77%  3484687 9223372036851291120    0%   /
devfs          352k   352k     0B   100%     1191                   0  100%   /dev
/dev/disk1s4   500G   1.1G   117G     1%        2 9223372036854775805    0%   /private/var/vm
map -hosts       0B     0B     0B   100%        0                   0  100%   /net
map auto_home    0B     0B     0B   100%        0                   0  100%   /home
```
