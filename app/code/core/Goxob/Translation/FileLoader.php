<?php namespace Goxob\Translation;

class FileLoader extends \Illuminate\Translation\FileLoader
{
    /**
     * {@inheritdoc}
     */
    protected function loadNamespaced($locale, $group, $namespace)
    {
        $items = parent::loadNamespaced($locale, $group, $namespace);
        if(count($items) > 0 )
        {
            return $items;
        }
        $file  = app_path()."/lang/packages/{$locale}/{$namespace}/{$group}.php";
        if ($this->files->exists($file)) {
            $items = $this->mergeEnvironment($items, $file);
            return $items;
        }
    }

    /**
     * Load the messages for the given locale.
     *
     * @param  string  $locale
     * @param  string  $group
     * @param  string  $namespace
     * @return array
     */
    public function load($locale, $group, $namespace = null)
    {
        $lines = $this->loadNamespaced($locale, $group, $namespace);
//        if(count($lines) == 0)
//        {
//            return $this->loadPath($this->path, $locale, $group);
//        }
//        if($group == 'global')//merge if group is global
//        {
//            $defaultLines = $this->loadPath($this->path, $locale, $group);
//            $lines = array_replace_recursive($lines, $defaultLines);
//        }
        $defaultLines = $this->loadPath($this->path, $locale, $group);
        if(is_array($lines)){
            $lines = array_replace_recursive($defaultLines, $lines);
            return $lines;
        }
        else{
            return $defaultLines;
        }
    }

    /**
     * Merge the items in the given file into the items.
     *
     * @param  array   $items
     * @param  string  $file
     * @return array
     */
    protected function mergeEnvironment(array $items, $file)
    {
        return array_replace_recursive($items, $this->files->getRequire($file));
    }
}
