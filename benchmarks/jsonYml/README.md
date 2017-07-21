## JSON vs YAML parser

#### Clone repository
```
$ git clone git@github.com:Erdiko/performance-tests.git
```

#### Initialize docker
```
$ cd performance-tests
$ docker-compose up &
$ docker exec -it erdiko_performance_php /bin/bash
```

#### Initialize composer and install lib dependencies

```
$ cd /benchmarks/jsonYml/scripts
$ sh run-setup.sh
```

This will install:

Composer dependencies
  - PhpBench [PhpBench Documentation](http://phpbench.readthedocs.io/en/latest/index.html)

PECL Package
 - Yaml [Yaml Package](https://pecl.php.net/package/yaml)

And also will add new bin for PhpBench
```
$ phpbench --help
```

#### Running benchmark

```
$ cd /benchmarks/jsonYml/scripts
$ sh run-bench.sh
```

#### Benchmark parameters

```
$ sh run-bench.sh -i 1000 -r 100 -s 1
```

These are the main parameters to run the benchmark:

 - Iterations: Iterations represent the number of times we will perform the benchmark (including all the revolutions). Contrary to revolutions, a time reading will be taken for each iteration.

Iteration Reference: [PhpBench Iteration Reference](http://phpbench.readthedocs.io/en/latest/writing-benchmarks.html#verifying-and-improving-stability-iterations)

 - Revolutions: The term “revolutions” (invented here) refers to the number of times the benchmark is executed consecutively within a single time measurement.

Revolution Reference: [PhpBench Revolution Reference](http://phpbench.readthedocs.io/en/latest/writing-benchmarks.html#improving-precision-revolutions)

 - File Size: The script generate a file to be processed  and the value for the size must be start from >= 1
   * 1 = 10KB
   * 5 = 50KB
   * 10 = 100KB
   * 50 = 500KB
   * 100 = 1 MB
   * 1000 = 100MB
   * 1000 = 1000MB

Default Values:
 - Iterations: 1000
 - Revolutions: 10
 - File Size: 1

## Results:
 
```
$ sh run-bench.sh -i 1000 -r 10 -s 1
 
Set 1000 Iterations
 
Set 10 Revolutions
 
Set 1000 KB as File Size to Process
 
PhpBench 0.14-dev (@git_version@). Running benchmarks.
 
\JsonYaml (#0 benchLoadJsonArray, #1 benchLoadObject, #2 benchYamlArray, #3 benchYamlObject)
 
#0  (σ = 10.953μs ) -2σ [    ▁█▇▄▂▂▁▁▁▁▁▁▁] +2σ [μ Mo]/r: 0.0842 0.0795 μRSD/r: 13.01%
#1  (σ = 13.095μs ) -2σ [    ▁▇█▃▂▁▂▁▁▁▁▁▁] +2σ [μ Mo]/r: 0.0925 0.0864 μRSD/r: 14.15%
#2  (σ = 45.977μs ) -2σ [   ▁▃█▆▅▄▂▂▁▁▁▁▁▁] +2σ [μ Mo]/r: 0.4395 0.4184 μRSD/r: 10.46%
#3  (σ = 50.018μs ) -2σ [   ▁▁█▆▄▄▂▁▁▁▁▁▁▁] +2σ [μ Mo]/r: 0.4402 0.4187 μRSD/r: 11.36%
 
4 subjects, 4,000 iterations, 40 revs, 0 rejects
(best [mean mode] worst) = 75.200 [264.081 250.738] 170.100 (μs)
⅀T: 1,056,324.800μs μSD/r 30.011μs μRSD/r: 12.248%
suite: 133c7e1138fc7989db08f7af074085cfce9a2004, date: 2017-07-21, stime: 21:04:22
 
+-----------+--------------------+--------+--------+------+------+----------+----------+----------+----------+----------+----------+--------+----------+
| benchmark | subject            | groups | params | revs | its  | mem_peak | best     | mean     | mode     | worst    | stdev    | rstdev | diff     |
+-----------+--------------------+--------+--------+------+------+----------+----------+----------+----------+----------+----------+--------+----------+
| JsonYaml  | benchLoadJsonArray | json   | []     | 10   | 1000 | 454,600b | 0.0752ms | 0.0842ms | 0.0795ms | 0.1757ms | 0.0110ms | 13.01% | 0.00%    |
| JsonYaml  | benchLoadObject    | json   | []     | 10   | 1000 | 457,232b | 0.0819ms | 0.0925ms | 0.0864ms | 0.1701ms | 0.0131ms | 14.15% | +9.92%   |
| JsonYaml  | benchYamlArray     | yaml   | []     | 10   | 1000 | 442,744b | 0.3921ms | 0.4395ms | 0.4184ms | 0.7117ms | 0.0460ms | 10.46% | +422.14% |
| JsonYaml  | benchYamlObject    | yaml   | []     | 10   | 1000 | 442,744b | 0.3901ms | 0.4402ms | 0.4187ms | 0.7743ms | 0.0500ms | 11.36% | +423.00% |
+-----------+--------------------+--------+--------+------+------+----------+----------+----------+----------+----------+----------+--------+----------+

```