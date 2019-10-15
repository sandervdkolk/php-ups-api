<?php

namespace Ups;

use DOMDocument;
use DOMNode;
use Exception;
use InvalidArgumentException;
use Psr\Log\LoggerInterface;
use SimpleXMLElement;
use Ups\Entity\Shipment;
use Ups\Entity\Pickup\PickupCreationRequest;
use Ups\Entity\ShipmentRequestLabelSpecification;
use Ups\Entity\ShipmentRequestReceiptSpecification;

/**
 * Package Shipping API Wrapper
 * Based on UPS Developer Guide, dated: 31 Dec 2012.
 */
class Pickup extends Ups
{
    const REQ_VALIDATE = 'validate';
    const REQ_NONVALIDATE = 'nonvalidate';

    /**
     * @var string
     */
    private $pickupEndpoint = '/pickup';

    private $request;

    /**
     * @param string|null $accessKey UPS License Access Key
     * @param string|null $userId UPS User ID
     * @param string|null $password UPS User Password
     * @param bool $useIntegration Determine if we should use production or CIE URLs.
     * @param RequestInterface|null $request
     * @param LoggerInterface|null PSR3 compatible logger (optional)
     */
    public function __construct($accessKey = null, $userId = null, $password = null, $useIntegration = false, RequestInterface $request = null, LoggerInterface $logger = null)
    {
        if (null !== $request) {
            $this->setRequest($request);
        }
        parent::__construct($accessKey, $userId, $password, $useIntegration, $logger);
    }

    /**
     * Create a Pickup request
     *
     * @return \stdClass
     */
    public function createPickupRequest(
        PickupCreationRequest $request
    )
    {
        return $this->sendRequest($request);
    }

}