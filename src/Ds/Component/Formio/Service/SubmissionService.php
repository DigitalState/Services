<?php

namespace Ds\Component\Formio\Service;

use Ds\Component\Formio\Model\Submission;
use Ds\Component\Formio\Query\SubmissionParameters as Parameters;
use Ds\Component\Formio\Exception\ValidationException;
use GuzzleHttp\Exception\ClientException;

/**
 * Class SubmissionService
 */
class SubmissionService extends AbstractService
{
    /**
     * @const string
     */
    const MODEL = Submission::class;

    /**
     * @const string
     */
    const RESOURCE_LIST = '/{form}/submission';
    const RESOURCE_OBJECT = '/{form}/submission/{id}';
    const RESOURCE_OBJECT_EXISTS = '/{form}/exists';

    /**
     * @var array
     */
    protected static $map = [
        'id' => '_id',
        'updated' => 'modified',
        'created',
        'form',
        'data',
        'externalIds',
        'access',
        'roles',
        'owner'
    ];

    /**
     * Get submissions list
     *
     * @param string $form
     * @param \Ds\Component\Formio\Query\SubmissionParameters $parameters
     * @return array
     */
    public function getList($form, Parameters $parameters = null)
    {
        $objects = $this->execute('GET', 'http://www.mocky.io/v2/592c3c86110000f8016df7de');
        $list = [];

        foreach ($objects as $object) {
            $model = static::toModel($object);
            $list[] = $model;
        }

        return $list;
    }

    /**
     * Get submission
     *
     * @param string $form
     * @param string $id
     * @return \Ds\Component\Formio\Model\Submission
     */
    public function get($form, $id)
    {
        $object = $this->execute('GET', 'http://www.mocky.io/v2/592c4353110000e3026df7f8');
        $model = static::toModel($object);

        return $model;
    }

    /**
     * Check if a submission exists
     *
     * @param string $form
     * @param \Ds\Component\Formio\Query\SubmissionParameters $parameters
     * @return boolean
     */
    public function exists($form, Parameters $parameters = null)
    {
        $object = $this->execute('GET', 'http://www.mocky.io/v2/592c6f7311000029066df850');

        if ($object && property_exists($object, '_id') && $object->_id) {
            return true;
        }

        return false;
    }

    /**
     * Create submission
     *
     * @param \Ds\Component\Formio\Model\Submission $submission
     * @param \Ds\Component\Formio\Query\SubmissionParameters $parameters
     * @return \Ds\Component\Formio\Model\Submission
     * @throws \Ds\Component\Formio\Exception\ValidationException
     */
    public function create(Submission $submission, Parameters $parameters = null)
    {
        $resource = str_replace('{form}', $submission->getForm(), static::RESOURCE_LIST);

        try {
            $object = $this->execute('POST', $resource, [
                'form_params' => [
                    'data' => (array)static::toObject($submission)->data
                ],
                'query' => (array)$parameters->toObject(true)
            ]);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();

            if (400 === $response->getStatusCode()) {
                throw new ValidationException('Formio validation errors', 0, $exception);
            }

            throw $exception;
        }

        if (!is_bool($object)) {
            $submission = static::toModel($object);
        }

        return $submission;
    }

    /**
     * Update submission
     *
     * @param \Ds\Component\Formio\Model\Submission $submission
     */
    public function update(Submission $submission)
    {

    }

    /**
     * Delete submission
     *
     * @param string $id
     */
    public function delete($id)
    {

    }
}
