<?php

/**
 * @Iterations(1000)
 * @Revs(10)
 * @OutputTimeUnit("milliseconds", precision=4)
 */
class JsonYaml
{
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
