<?php

namespace AppBundle\Validator\Constraints\Scenario\Config;

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
        $config = $scenario->getConfig();

        switch ($scenario->getType()) {
            case Scenario::TYPE_API:
                $this->validateApi($config, $constraint);
                break;

            case Scenario::TYPE_BPM:
                $this->validateBpm($config, $constraint);
                break;

            case Scenario::TYPE_INFO:
                $this->validateInfo($config, $constraint);
                break;

            case Scenario::TYPE_URL:
                $this->validateUrl($config, $constraint);
                break;
        }
    }

    /**
     * Validate api scenario config
     *
     * @param array $config
     * @param \Symfony\Component\Validator\Constraint $constraint
     */
    protected function validateApi(array $config, Constraint $constraint)
    {

    }

    /**
     * Validate bpm scenario config
     *
     * @param array $config
     * @param \Symfony\Component\Validator\Constraint $constraint
     */
    protected function validateBpm(array $config, Constraint $constraint)
    {
        foreach (['bpm', 'process_definition_key'] as $attribute) {
            if (!array_key_exists($attribute, $config)) {
                $this->context
                    ->buildViolation($constraint->missing)
                    ->setParameter('{{ attribute }}', '"'.$attribute.'"')
                    ->atPath('config.'.$attribute)
                    ->addViolation();
            }
        }
    }

    /**
     * Validate info scenario config
     *
     * @param array $config
     * @param \Symfony\Component\Validator\Constraint $constraint
     */
    protected function validateInfo(array $config, Constraint $constraint)
    {

    }

    /**
     * Validate url scenario config
     *
     * @param array $config
     * @param \Symfony\Component\Validator\Constraint $constraint
     */
    protected function validateUrl(array $config, Constraint $constraint)
    {
        foreach (['url'] as $attribute) {
            if (!array_key_exists($attribute, $config)) {
                $this->context
                    ->buildViolation($constraint->missing)
                    ->setParameter('{{ attribute }}', '"'.$attribute.'"')
                    ->atPath('config.'.$attribute)
                    ->addViolation();
            }
        }
    }
}
