<?php
namespace App\Entity;

class Invoice extends AbstractEntity implements GenericEntityInterface
{
    /**
     * @var string
     */
    private $reference = '';

    /**
     * @var null
     */
    private $customer = null;

    /**
     * @var array
     */
    private $items = [];

    /**
     * @var null|Status
     */
    private $status = null;

    /**
     * @var float
     */
    private $total = 0.0;

    /**
     * @var float
     */
    private $vat = 0.0;

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @return null
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return null|Status
     */
    public function getStatus():?Status
    {
        return $this->status;
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * @return float
     */
    public function getVat(): float
    {
        return $this->vat;
    }

    /**
     * @param string $reference
     *
     * @return Invoice
     */
    public function setReference(string $reference): Invoice
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * @param float $total
     *
     * @return Invoice
     */
    public function setTotal(float $total): Invoice
    {
        $this->total = $total;
        return $this;
    }

    /**
     * @param float $vat
     *
     * @return Invoice
     */
    public function setVAT(float $vat): Invoice
    {
        $this->vat = $vat;
        return $this;
    }

    /**
     * @param InvoiceItem $invoiceItem
     *
     * @return Invoice
     */
    public function addItem(InvoiceItem $invoiceItem): Invoice
    {
        if(false === $this->doesItemsContain($invoiceItem)) {
            $this->items[] = $invoiceItem;
        }

        return $this;
    }

    /**
     * @param array $items
     * @return Invoice
     */
    public function setItems(array $items): Invoice
    {
        $this->resetItems();
        foreach($items as $item) {
            $this->addItem($item);
        }
        return $this;
    }

    /**
     * @return Invoice
     */
    public function resetItems(): Invoice
    {
        $this->items = [];
        return $this;
    }

    /**
     * @param InvoiceItem $object
     * @return bool
     */
    public function doesItemsContain(InvoiceItem $object):bool
    {
        foreach ($this->getItems() as $item) {
            if($item === $object) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param null $status
     * @return Invoice
     */
    public function setStatus($status):Invoice
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param null $customer
     * @return Invoice
     */
    public function setCustomer($customer):Invoice
    {
        $this->customer = $customer;
        return $this;
    }

}