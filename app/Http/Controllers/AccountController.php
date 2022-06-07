<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Repositories\AccountRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use App\Models\Account;

class AccountController extends AppBaseController
{
    /** @var  AccountRepository */
    private $accountRepository;

    public function __construct(AccountRepository $accountRepo)
    {
        $this->accountRepository = $accountRepo;
    }

    /**
     * Display a listing of the Account.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->accountRepository->pushCriteria(new RequestCriteria($request));
        $accounts = $this->accountRepository->all();

        return view('accounts.index')
            ->with('accounts', $accounts);
    }


    public function apply_for_payout(Request $request){
        /**
         * Receive Account Id
         * Check if logged in user is the same as owner of account
         * Update applied for payout field in accounts table
         * Redirect and display success message
         */

         $account = $this->accountRepository->findWithoutFail($request-> input ('apply_for_payout'));

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect()->back();
        }

        if(Auth::user()->id != $account->user_id){
            Flash::error('Operation Denied');

            return redirect()->back();

        }

        Account::where('id', $account->id)->update([
            'applied_for_payout'=>1
        ]);

        Flash::success('Application submitted successfully');
        return redirect()->back();


    }

    public function mark_as_paid(Request $request){




    }


    /**
     * Show the form for creating a new Account.
     *
     * @return Response
     */
    public function create()
    {
        return view('accounts.create');
    }

    /**
     * Store a newly created Account in storage.
     *
     * @param CreateAccountRequest $request
     *
     * @return Response
     */
    public function store(CreateAccountRequest $request)
    {
        $input = $request->all();

        $account = $this->accountRepository->create($input);

        Flash::success('Account saved successfully.');

        return redirect(route('accounts.index'));
    }

    /**
     * Display the specified Account.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $account = $this->accountRepository->findWithoutFail($id);

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }
        $accountHistories = $account->account_histories;
        return view('accounts.show')
        ->with('accountHistories', $accountHistories)
        ->with('account', $account);
    }

    /**
     * Show the form for editing the specified Account.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $account = $this->accountRepository->findWithoutFail($id);

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }

        return view('accounts.edit')->with('account', $account);
    }

    /**
     * Update the specified Account in storage.
     *
     * @param  int              $id
     * @param UpdateAccountRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAccountRequest $request)
    {
        $account = $this->accountRepository->findWithoutFail($id);

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }

        $account = $this->accountRepository->update($request->all(), $id);

        Flash::success('Account updated successfully.');

        return redirect(route('accounts.index'));
    }

    /**
     * Remove the specified Account from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $account = $this->accountRepository->findWithoutFail($id);

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }

        $this->accountRepository->delete($id);

        Flash::success('Account deleted successfully.');

        return redirect(route('accounts.index'));
    }
}
