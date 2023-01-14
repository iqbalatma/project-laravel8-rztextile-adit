<?php

namespace App\Services;

use App\AppData;
use App\Http\Traits\WablasTrait;
use App\Repositories\CustomerRepository;
use App\Repositories\PromotionMessageRepository;

class WhatsappMessagingService
{
    private const GET_ALL_PROMOTION_MESSAGE_COLUMN = [
        AppData::TABLE_PROMOTION_MESSAGE . ".id",
        AppData::TABLE_PROMOTION_MESSAGE . ".name",
    ];

    private const GET_CUSTOMER_BY_IDS_COLUMN = [
        AppData::TABLE_USER . ".phone",
    ];

    public function getAllData(): array
    {
        return [
            "title"             => "Whatsapp Messaging",
            "description"       => "Send promotion broadcast message to customer",
            "cardTitle"         => "Whatsapp Messaging",
            "customers"         => (new CustomerRepository())->getAllDataCustomer(),
            "promotionMessages" => (new PromotionMessageRepository())->getAllDataPromotionMessage(self::GET_ALL_PROMOTION_MESSAGE_COLUMN)
        ];
    }

    public function sendMessage(array $requestedData)
    {
        $payloads = $this->getDataPayload($requestedData);
        return WablasTrait::sendMessage($payloads);
    }

    private function getDataPayload(array $requestedData): array
    {
        $customers = (new CustomerRepository())->getCustomerByIds($requestedData["customer"], self::GET_CUSTOMER_BY_IDS_COLUMN);

        $message = preg_replace('/<strong>|<\/strong>/', '*', $requestedData["message"]);
        $message = preg_replace('/&nbsp;/', '', $message);
        $message = preg_replace('/<em>|<\/em>/', '_', $message);
        $message = preg_replace('/<p>|<\/p>/', '', $message);
        $payload = collect($customers)->map(function ($item) use ($message) {

            return [
                "phone"   => preg_replace('/[^0-9]/', '', $item->phone),
                "message" => $message
            ];
        })->toArray();
        return ["data" => $payload];
    }
}
