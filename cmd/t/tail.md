# tail

output the last part of files

---

References

- `man tail`

Sysnopsis

```bash
tail [OPTION]... [FILE]...
```

## Options

### Amount

- `-n, --lines=[-]K` Print the last K lines instead of the last 10;
    - or use `-n +K` to output starting with the Kth
- `-c, --bytes=[-]K` Print the last K bytes of each file;
    - or use `-c +K` to output bytes starting with the Kth of each file

K may have a multiplier suffix:

- b : 512
- kB : 1000
- K : 1024
- MB : 1000\*1000
- M : 1024\*1024
- GB : 1000\*1000\*1000
- G : 1024\*1024\*1024
- and so on for T, P, E, Z, Y.

### Appended

- `-f, --follow[={name|descriptor}]` Output appended data as the file grows
- `-F` same as `--follow=name --retry`
- `--retry` Keep trying to open a file if it is inaccessible

### Others

- `-pid=PID` With `-f`, terminate after process ID, PID dies

## Usage

### Default

Print 10 lines

```bash
$ tail LICENSE

The Licensor shall not be bound by any additional or different terms or conditions communicated by You unless expressly agreed.
Any arrangements, understandings, or agreements regarding the Licensed Material not stated herein are separate from and independent of the terms and conditions of this Public License.

Section 8 – Interpretation.

For the avoidance of doubt, this Public License does not, and shall not be interpreted to, reduce, limit, restrict, or impose conditions on any use of the Licensed Material that could lawfully be made without permission under this Public License.
To the extent possible, if any provision of this Public License is deemed unenforceable, it shall be automatically reformed to the minimum extent necessary to make it enforceable. If the provision cannot be reformed, it shall be severed from this Public License without affecting the enforceability of the remaining terms and conditions.
No term or condition of this Public License will be waived and no failure to comply consented to unless expressly agreed to by the Licensor.
Nothing in this Public License constitutes or may be interpreted as a limitation upon, or waiver of, any privileges and immunities that apply to the Licensor or You, including from the legal processes of any jurisdiction or authority.
```

### Common

Print the last line

```bash
$ tail -1 index.html
</html>
```

Print last 12 lines

```bash
$ tail -12 index.html
  <script src="https://cdn.icehe.xyz/_docsify/resources/__unpkg.com_prismjs_components_prism-nasm.min.js"></script>
  <!-- <script src="https://cdn.icehe.xyz/_docsify/resources/__unpkg.com_prismjs_components_prism-php.min.js"></script> -->
  <!-- <script src="https://cdn.icehe.xyz/_docsify/resources/__unpkg.com_prismjs_components_prism-properties.min.js"></script> -->
  <script src="https://cdn.icehe.xyz/_docsify/resources/__unpkg.com_prismjs_components_prism-python.min.js"></script>
  <!-- <script src="https://cdn.icehe.xyz/_docsify/resources/__unpkg.com_prismjs_components_prism-ruby.min.js"></script> -->
  <script src="https://cdn.icehe.xyz/_docsify/resources/__unpkg.com_prismjs_components_prism-sql.min.js"></script>
  <!-- <script src="https://cdn.icehe.xyz/_docsify/resources/__unpkg.com_prismjs_components_prism-vim.min.js"></script> -->
  <!-- <script src="https://cdn.icehe.xyz/_docsify/resources/__unpkg.com_prismjs_components_prism-wiki.min.js"></script> -->
  <!-- <script src="https://cdn.icehe.xyz/_docsify/resources/__unpkg.com_prismjs_components_prism-yaml.min.js"></script> -->

</body>
</html>
```

### Realtime

Display new data appended to file

```bash
$ tail -f info.log
```

#### Replacement

```bash
$ less info.log
# And then : press the interative command `F` ( Shift + F ) !
```

### All But Top

Print print all but the top 36 lines

```bash
$ tail -n +36 for.sh

do_pressure_test 'seq 300 5 440' 'show'  'thrpt'
do_pressure_test 'seq 300 5 440' 'show'  'avgt'
do_pressure_test 'seq 300 5 440' 'show'  'sample'
```
