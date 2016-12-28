<?php

namespace Ds\Bundle\AssetBundle\Controller\Api\Rest;

use Oro\Bundle\SoapBundle\Controller\Api\Rest\RestController;

use FOS\RestBundle\Controller\Annotations\NamePrefix;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * Class AssetController
 *
 * @RouteResource("asset")
 * @NamePrefix("ds_asset_api_rest_")
 */
class AssetController extends RestController
{
    /**
     * Get collection action
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @AclAncestor("ds.asset.asset.view")
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
     * @AclAncestor("ds.asset.asset.view")
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
     * @AclAncestor("ds.asset.asset.edit")
     */
    public function putAction($id)
    {
        return $this->handleUpdateRequest($id);
    }

    /**
     * Post action
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @AclAncestor("ds.asset.asset.create")
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
     * @AclAncestor("ds.asset.asset.delete")
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
        return $this->get('ds.asset.form.api.asset');
    }

    /**
     * {@inheritdoc}
     */
    public function getFormHandler()
    {
        return $this->get('ds.asset.form.handler.asset');
    }

    /**
     * {@inheritdoc}
     */
    public function getManager()
    {
        return $this->get('ds.asset.manager.asset');
    }
}
