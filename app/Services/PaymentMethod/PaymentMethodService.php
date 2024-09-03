<?php

namespace App\Services\PaymentMethod;

use App\Models\PaymentMethod\PaymentMethod;

class PaymentMethodService
{
    public function getAllPaymentMethods()
    {
        return PaymentMethod::all();
    }
    /**
     * Create a new payment method.
     *
     * @param array $data
     * @return \App\Models\Payment\PaymentMethod
     */
    public function createPaymentMethod(array $data)
    {
        return PaymentMethod::create($data);
    }

    /**
     * Update an existing payment method.
     *
     * @param array $data
     * @param int $id
     * @return \App\Models\Payment\PaymentMethod
     */
    public function updatePaymentMethod(array $data, int $id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        $paymentMethod->update($data);
        return $paymentMethod;
    }

    /**
     * Get a payment method by ID.
     *
     * @param int $id
     * @return \App\Models\Payment\PaymentMethod|null
     */
    public function getPaymentMethodById(int $id)
    {
        return PaymentMethod::find($id);
    }
    public function deletePaymentMethod(string $id)
    {
        $paymentMethod = $this->getPaymentMethodById($id);

        if (!$paymentMethod) {
            return false;
        }

        return $paymentMethod->delete();
    }


}