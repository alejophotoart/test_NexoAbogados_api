<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id'                => $this->id,
            'price_id'          => $this->price_id,
            'date_subscription' => $this->date_subscription,
            'confirmed'         => $this->confirmed,
            'user_id'           => $this->user_id,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
            'user' => [
                'id'            => $this->user->id, 
                'name'          => $this->user->name,
                'email'         => $this->user->email,
                'subscribed'    => $this->user->subscribed,
                'active'        => $this->user->active,
                'created_at'    => $this->created_at,
                'updated_at'    => $this->updated_at,
            ],
            // 'recurrent' => [
            //     'id'                => $this->recurrent->id,
            //     'date_recurrent'    => $this->recurrent->date_recurrent,
            //     'subscription_id'   => $this->recurrent->subscription_id,
            //     'created_at'        => $this->created_at,
            //     'updated_at'        => $this->updated_at,
            // ],
            'price_subs' => [
                'id'            => $this->price_subs->id,
                'price'         => "$".number_format($this->price_subs->price, 2, ",", "."),
                'active'        => $this->price_subs->active,
                'created_at'    => $this->created_at,
                'updated_at'    => $this->updated_at,   
            ],
            // 'subs_rec_trie' => [
            //     'id'            => $this->subs_rec_trie->id,
            //     'tries'         => $this->subs_rec_trie->tries,
            //     'recurrent_id'  => $this->subs_rec_trie->recurrent_id,
            //     'created_at'    => $this->created_at,
            //     'updated_at'    => $this->updated_at, 
            // ]
        ];
    }
}
