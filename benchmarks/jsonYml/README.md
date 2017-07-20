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
$ sh run-bench.sh -i 5000 -r 1000
```

These are the main parameters to run the benchmark:

 - Iterations: Iterations represent the number of times we will perform the benchmark (including all the revolutions). Contrary to revolutions, a time reading will be taken for each iteration.

Iteration Reference: [PhpBench Iteration Reference](http://phpbench.readthedocs.io/en/latest/writing-benchmarks.html#verifying-and-improving-stability-iterations)

 - Revolutions: The term “revolutions” (invented here) refers to the number of times the benchmark is executed consecutively within a single time measurement.

Revolution Reference: [PhpBench Revolution Reference](http://phpbench.readthedocs.io/en/latest/writing-benchmarks.html#improving-precision-revolutions)

Default Values:
 - Iterations: 1000
 - Revolutions 10
