<?php

require_once '../../vendor/fzaninotto/faker/src/autoload.php';

/**
 * @BeforeClassMethods({"up"});
 * @AfterClassMethods({"down"})
 *
 * @Iterations(1000)
 * @Revs(10)
 * @OutputTimeUnit("milliseconds", precision=4)
 */
class JsonYaml
{
    const FILE_TEST_NAME = 'test';

    /**
     * FileSize Values
     *
     * 1 = 10KB
     * 5 = 50KB
     * 10 = 100KB
     * 50 = 500KB
     * 100 = 1 MB
     * 1000 = 100MB
     * 1000 = 1000MB
     */
    public static function up()
    {
        $dataLength = getenv('FILESIZE')?: 0.01;
        $dataSize = $dataLength*10;

        if ($dataLength >= 100) {
            throw new \Exception('Is not recommended create a file more than of a 1GB.');
        }

        if ($dataLength >= 50) {
            ini_set('memory_limit', '-1');
        }

        $config = include('config/generator.php');
        $data = [];
        $faker = Faker\Factory::create();
        for ($i=0; $i<=$dataSize; $i++) {
            foreach ($config as $entity => $valueData) {
                $entityData = [];
                foreach ($valueData as $valueIndex => $valueData) {
                    $entityData[$valueIndex] = JsonYaml::getFakerValue($faker, $valueData);
                }
                $data[][$entity] = $entityData;
            }
        }

        $jsonGeneratedPath = __DIR__.'/files/'.self::FILE_TEST_NAME.'.json';
        $yamlGeneratedPath = __DIR__.'/files/'.self::FILE_TEST_NAME.'.yml';

        file_put_contents($jsonGeneratedPath, json_encode($data, JSON_PRETTY_PRINT));
        yaml_emit_file($yamlGeneratedPath, $data);
    }

    protected static function getFakerValue($faker, $valueData)
    {
        $classMethod = explode('@', $valueData[0]);
        $method = $classMethod[1];
        $params = $valueData[1];

        $value = $faker->$method($params);

        return $value;
    }

    public static function down()
    {
        unlink(__DIR__.'/files/'.self::FILE_TEST_NAME.'.json');
        unlink(__DIR__.'/files/'.self::FILE_TEST_NAME.'.yml');
    }

    /**
     * @Groups({"json"})
     */
    public function benchLoadJsonArray()
    {
        $this->loadJson($this->getFilePath('test.json'), true);
    }

    /**
     * @Groups({"json"})
     */
    public function benchLoadObject()
    {
        $this->loadJson($this->getFilePath('test.json'));
    }

    /**
     * @Groups({"yaml"})
     */
    public function benchYamlArray()
    {
        yaml_parse_file($this->getFilePath('test.yml'));
    }

    /**
     * @Groups({"yaml"})
     */
    public function benchYamlObject()
    {
        (object) yaml_parse_file($this->getFilePath('test.yml'));
    }

    protected function getFilePath($filename)
    {
        return $path = realpath(__DIR__.'/files')."/".$filename;
    }

    protected function loadJson($jsonPath, $array=false)
    {
        return json_decode(file_get_contents($jsonPath), $array);
    }
}
