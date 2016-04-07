<?php
/**
 * OnePica
 * NOTICE OF LICENSE
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to codemaster@onepica.com so we can send you a copy immediately.
 *
 * @category  Affirm
 * @package   OnePica_Affirm
 * @copyright Copyright (c) 2016 One Pica, Inc. (http://www.onepica.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace OnePica\Affirm\Gateway\Http;

use Magento\Payment\Gateway\Http\TransferInterface;
use OnePica\Affirm\Gateway\Http\Client\ClientService;

class TransferFactory extends AbstractTransferFactory
{
    /**
     * Builds gateway transfer object
     *
     * @param array $request
     * @return TransferInterface
     */
    public function create(array $request)
    {
        return $this->transferBuilder
            ->setMethod(ClientService::POST)
            ->setHeaders(['Content-Type' => 'application/json'])
            ->setBody(json_encode($request, JSON_UNESCAPED_SLASHES))
            ->setAuthUsername($this->getPublicApiKey())
            ->setAuthPassword($this->getPrivateApiKey())
            ->setUri($this->getApiUrl())
            ->build();
    }

    /**
     * Get Api url
     *
     * @return string
     */
    private function getApiUrl()
    {
        return $this->action->getUrl();
    }
}
