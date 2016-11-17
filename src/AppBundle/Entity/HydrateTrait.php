<?php
/**
 * User: Neofox
 * Date: 08/11/2016
 * Time: 17:50
 */

namespace AppBundle\Entity;


trait HydrateTrait
{
    /**
     * Hydrate an object with data
     *
     * @param array $data
     *
     * @return $this
     * @throws \Exception
     */
    public function hydrate(array $data)
    {

        foreach ($data as $property => $value) {

            $method = sprintf('set%s', ucwords($property));

            try{

                //if(method_exists())
                $this->$method($value);

            }catch(\Error $t){

                throw new \Exception(sprintf('The method "%s" does not exist. Is "%s" a valid property?', $method, $property));
            }
        }

        return $this;
    }

}