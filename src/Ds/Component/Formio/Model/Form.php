<?php

namespace Ds\Component\Formio\Model;

/**
 * Class Form
 */
class Form implements Model
{
    use Attribute\Id;
    use Attribute\Updated;
    use Attribute\Created;
    use Attribute\Name;
    use Attribute\Path;
    use Attribute\Title;
    use Attribute\Display;
    use Attribute\Type;
    use Attribute\Components;
    use Attribute\Tags;
    use Attribute\SubmissionAccess;
    use Attribute\Access;
    use Attribute\Owner;
}
