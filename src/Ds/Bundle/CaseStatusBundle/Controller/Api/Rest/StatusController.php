<?php

namespace Ds\Bundle\CaseStatusBundle\Controller\Api\Rest;

use Ds\Bundle\ApiBundle\Controller\Api\Rest\AbstractController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations\NamePrefix;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * Class CaseStatusController
 *
 * @RouteResource("status")
 * @Route("/case")
 * @NamePrefix("ds_casestatus_api_rest_")
 */
class StatusController extends AbstractController
{
    /**
     * Get collection action
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @AclAncestor("ds.casestatus.status.view")
     * @QueryParam(name="page", requirements="\d+", nullable=true)
     * @QueryParam(name="limit", requirements="\d+", nullable=true)
     */
    public function cgetAction()
    {
        $request = $this->get('request');
        $page = (integer) $request->get('page', 1);
        $limit = (integer) $request->get('limit', self::ITEMS_PER_PAGE);
        $criteria = $this->getFilterCriteria($this->getSupportedQueryParameters(__FUNCTION__));

        return $this->handleGetListRequest($page, $limit, $criteria);
    }

    /**
     * Get action
     *
     * @param integer $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @AclAncestor("ds.casestatus.status.view")
     */
    public function getAction($id)
    {
        return $this->handleGetRequest($id);
    }

    /**
     * Put action
     *
     * @param integer $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @AclAncestor("ds.casestatus.status.edit")
     */
    public function putAction($id)
    {
        return $this->handleUpdateRequest($id);
    }

    /**
     * Post action
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @AclAncestor("ds.casestatus.status.create")
     */
    public function postAction()
    {
        return $this->handleCreateRequest();
    }

    /**
     * Delete action
     *
     * @param integer $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @AclAncestor("ds.casestatus.status.delete")
     */
    public function deleteAction($id)
    {
        return $this->handleDeleteRequest($id);
    }

    /**
     * {@inheritdoc}
     */
    public function getForm()
    {
        return $this->get('ds.casestatus.form.api.status');
    }

    /**
     * {@inheritdoc}
     */
    public function getFormHandler()
    {
        return $this->get('ds.casestatus.form.handler.status');
    }

    /**
     * {@inheritdoc}
     */
    public function getManager()
    {
        return $this->get('ds.casestatus.manager.status');
    }

    /**
     * {@inheritdoc}
     */
    protected function transformEntityField($field, &$value)
    {
        switch ($field) {
            case 'case':
                $value = $this->transformEntityToId($value);
                break;

            case 'titles':
            case 'descriptions':
                $value = $this->transformLocalizedValuesToTexts($value);
                break;

            default:
                parent::transformEntityField($field, $value);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getFallbackLocalizationFields()
    {
        return [ 'titles', 'descriptions' ];
    }
}
