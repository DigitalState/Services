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
            case Scenario::TYPE_BPM:
                foreach (['bpm', 'process_definition_key'] as $attribute) {
                    if (!array_key_exists($attribute, $data)) {
                        $this->context
                            ->buildViolation($constraint->missing)
                            ->setParameter('{{ attribute }}', '"'.$attribute.'""')
                            ->atPath('data.'.$attribute)
                            ->addViolation();
                    }
                }

                break;

            case Scenario::TYPE_API:
            case Scenario::TYPE_INFO:
            case Scenario::TYPE_URL:

                break;
        }
    }
}
