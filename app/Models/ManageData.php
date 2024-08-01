<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageData extends Model
{
    use HasFactory;

    protected $fillable = ['loop_subscriber_id','shopify_id','customer_email_address','customer_billing_address','customer_shipping_address','all_order_ids','join_date','next_billing_date','subscription_status','unique_customer_number','last_golden_ticket','customer_notes','type','status'];
}
