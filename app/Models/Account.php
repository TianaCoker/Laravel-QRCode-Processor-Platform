<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Account
 * @package App\Models
 * @version June 1, 2022, 3:40 pm UTC
 *
 * @property integer user_id
 * @property number balance
 * @property number total_debit
 * @property number total_credit
 * @property string withdrawal_method
 * @property string payment_email
 * @property string bank_name
 * @property string bank_branch
 * @property string bank_account
 * @property integer applied_for_payout
 * @property integer paid
 * @property string last_date_applied
 * @property string last_date_paid
 * @property string country
 * @property string other_details
 */
class Account extends Model
{
    use SoftDeletes;

    public $table = 'accounts';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'balance',
        'total_debit',
        'total_credit',
        'withdrawal_method',
        'payment_email',
        'bank_name',
        'bank_branch',
        'bank_account',
        'applied_for_payout',
        'paid',
        'last_date_applied',
        'last_date_paid',
        'country',
        'other_details'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'balance' => 'float',
        'total_debit' => 'float',
        'total_credit' => 'float',
        'withdrawal_method' => 'string',
        'payment_email' => 'string',
        'bank_name' => 'string',
        'bank_branch' => 'string',
        'bank_account' => 'string',
        'applied_for_payout' => 'integer',
        'paid' => 'integer',
        'last_date_applied' => 'date',
        'last_date_paid' => 'date',
        'country' => 'string',
        'other_details' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'balance' => 'required',
        'total_debit' => 'required',
        'total_credit' => 'required',
        'withdrawal_method' => 'required',
        'applied_for_payout' => 'required',
        'paid' => 'required'
    ];

    /**
     * Get the user record associated with the account.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function account_histories()
    {
        return $this->hasMany('App\Models\AccountHistory');
    }
}
