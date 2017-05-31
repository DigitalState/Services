<?php

namespace Ds\Component\Formio\Model;

/**
 * Class User
 */
class User implements Model
{
    use Attribute\Id;
    use Attribute\Updated;
    use Attribute\Created;
    use Attribute\Form;
    use Attribute\Data;
    use Attribute\ExternalIds;
    use Attribute\Access;
    use Attribute\Roles;
    use Attribute\Owner;
}
