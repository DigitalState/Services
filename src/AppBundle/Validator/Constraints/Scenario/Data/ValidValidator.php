<?php

namespace AppBundle\Validator\Constraints\Scenario\Data;

use AppBundle\Entity\Scenario;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class ValidValidator
 */
class ValidValidator extends ConstraintValidator
{
    /**
     * {@inheritdoc}
     */
    public function validate($scenario, Constraint $constraint)
    {
        $data = $scenario->getData();

        switch ($scenario->getType()) {
            case Scenario::TYPE_API:
                $this->validateApi($data, $constraint);
                break;

            case Scenario::TYPE_BPM:
                $this->validateBpm($data, $constraint);
                break;

            case Scenario::TYPE_INFO:
                $this->validateInfo($data, $constraint);
                break;

            case Scenario::TYPE_URL:
                $this->validateUrl($data, $constraint);
                break;
        }
    }

    /**
     * Validate api scenario data
     *
     * @param array $data
     * @param \Symfony\Component\Validator\Constraint $constraint
     */
    protected function validateApi(array $data, Constraint $constraint)
    {

    }

    /**
     * Validate bpm scenario data
     *
     * @param array $data
     * @param \Symfony\Component\Validator\Constraint $constraint
     */
    protected function validateBpm(array $data, Constraint $constraint)
    {
        foreach (['bpm', 'process_definition_key'] as $attribute) {
            if (!array_key_exists($attribute, $data)) {
                $this->context
                    ->buildViolation($constraint->missing)
                    ->setParameter('{{ attribute }}', '"'.$attribute.'"')
                    ->atPath('data.'.$attribute)
                    ->addViolation();
            }
        }
    }

    /**
     * Validate info scenario data
     *
     * @param array $data
     * @param \Symfony\Component\Validator\Constraint $constraint
     */
    protected function validateInfo(array $data, Constraint $constraint)
    {

    }

    /**
     * Validate url scenario data
     *
     * @param array $data
     * @param \Symfony\Component\Validator\Constraint $constraint
     */
    protected function validateUrl(array $data, Constraint $constraint)
    {

    }
}
