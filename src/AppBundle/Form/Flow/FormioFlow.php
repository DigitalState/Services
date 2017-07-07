<?php

namespace AppBundle\Form\Flow;

use Craue\FormFlowBundle\Form\FormFlow;
use OutOfBoundsException;

/**
 * Class FormioFlow
 */
class FormioFlow extends FormFlow
{
    /**
     * @var string
     */
    protected $name; # region accessors

    /**
     * Set name
     *
     * @param string $name
     * @return \AppBundle\Form\Flow\FormioFlow
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return $this->name;
    }

    # endregion

    /**
     * @var array
     */
    protected $stepsConfig; # region accessors

    /**
     * Set steps config
     *
     * @param array $stepsConfig
     * @return \AppBundle\Form\Flow\FormioFlow
     */
    public function setStepsConfig($stepsConfig)
    {
        $this->stepsConfig = $stepsConfig;

        return $this;
    }

    # endregion

    /**
     * @var string
     */
    protected $formSchemaKey; # region accessors

    /**
     * Get form schema key
     *
     * @return string
     */
    public function getFormSchemaKey() {
        if ($this->formSchemaKey === null) {
            $this->formSchemaKey = $this->getId() . '_schema';
        }

        return $this->formSchemaKey;
    }

    # endregion

    /**
     * @var array
     */
    protected $formSchema; # region accessors

    /**
     * Get form schema key
     *
     * @return string
     */
    public function getFormSchema() {
        if ($this->formSchema === null) {
            $this->formSchema = json_decode(file_get_contents());
        }

        return $this->formSchema;
    }

    # endregion

    /**
     * Set options
     *
     * @param array $options
     * @return \AppBundle\Form\Flow\FormioFlow
     * @throws \OutOfBoundsException
     */
    public function setOptions(array $options)
    {
        foreach ($options as $key => $value) {
            if (!in_array($key, [ 'allowDynamicStepNavigation' ])) {
                throw new OutOfBoundsException('Option does not exist.');
            }

            $this->$key = $value;
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function loadStepsConfig()
    {
        return $this->stepsConfig;
    }
}
