<?php

namespace Ds\Component\Formio\Query\Attribute;

/**
 * Trait Form
 */
trait Form
{
    /**
     * @var string
     */
    protected $form; # region accessors

    /**
     * Set form
     *
     * @param string $form
     * @return object
     */
    public function setForm($form)
    {
        $this->form = $form;
        $this->_form = true;

        return $this;
    }

    /**
     * Get form
     *
     * @return string
     */
    public function getForm()
    {
        return $this->form;
    }

    # endregion

    /**
     * @var boolean
     */
    protected $_form;
}
