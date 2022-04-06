@extends('layouts.layout')
@push('header')
    @if (old('account_name') || isset($invoice->invoiceItems))
        <meta name="clear-invoice-html" content="clean">
    @endif
    <meta name="invoice-total" content="{{ old('total', $invoice->total ?? 0) }}">
    <meta name="invoice-grand-total" content="{{ old('grand_total', $invoice->grand_total ?? 0) }}">
@endpush

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('invoices.index') }}">@lang('Invoice')</a></li>
                    <li class="breadcrumb-item active">@lang('Edit Invoice')</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('Edit Invoice')</h3>
            </div>
            <div class="card-body">
                <form class="form-material form-horizontal" action="{{ route('invoices.update', $invoice) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="user_id">@lang('Select Patient') <b class="ambitious-crimson">*</b></label>
                                <select name="user_id" id="user_id" class="form-control custom-width-100 select2 @error('user_id') is-invalid @enderror" required>
                                    <option value="">--@lang('Select')--</option>
                                    @foreach($patients as $patient) {
                                        <option value="{{ $patient->id }}" @if($patient->id == old('user_id', $invoice->user_id)) selected @endif>{{ $patient->id.'. '.$patient->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="insurance_id">@lang('Select Insurance')</label>
                                <select name="insurance_id" id="insurance_id" class="form-control custom-width-100 select2 @error('insurance_id') is-invalid @enderror">
                                    <option value="">--@lang('Select')--</option>
                                    @foreach($insurances as $insurance) {
                                        <option value="{{ $insurance->id }}" @if($insurance->id == old('insurance_id', $invoice->insurance_id)) selected @endif>{{ $insurance->id.'. '.$insurance->name }}</option>
                                    @endforeach
                                </select>
                                @error('insurance_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('Invoice Date') <b class="ambitious-crimson">*</b></label>
                                <input type="text" name="invoice_date" id="invoice_date" class="form-control @error('invoice_date') is-invalid @enderror" placeholder="@lang('Invoice Date')" value="{{ old('invoice_date', $invoice->invoice_date) }}" readonly required>
                                @error('invoice_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="t1" class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="custom-th-width-20">@lang('Account Name')</th>
                                            <th scope="col" class="custom-th-width-25">@lang('Description')</th>
                                            <th scope="col">@lang('Quantity')</th>
                                            <th scope="col" class="custom-th-width-15">@lang('Price')</th>
                                            <th scope="col" class="custom-th-width-15">@lang('Sub Total')</th>
                                            <th scope="col" class="custom-white-space">@lang('Add / Remove')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (old('account_name'))
                                            @foreach (old('account_name') as $key => $value)
                                                <tr>
                                                    <td>
                                                        <select name="account_name[]" class="form-control select2" required>
                                                            <option value="">--@lang('Select')--</option>
                                                            @foreach ($accountHeaders as $accountHeader)
                                                                <option value="{{ $accountHeader->name }}" @if(old('account_name')[$key] == $accountHeader->name) selected @endif>{{ $accountHeader->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <textarea name="description[]" class="form-control" rows="1" placeholder="@lang('Description')">{{ old('description')[$key] }}</textarea>
                                                    </td>
                                                    <td>
                                                        <input type="number" step=".01" name="quantity[]" class="form-control quantity" value="{{ old('quantity')[$key] }}" placeholder="@lang('Quantity')" required>
                                                    </td>
                                                    <td>
                                                        <input type="number" step=".01" name="price[]" class="form-control price" value="{{ old('price')[$key] }}" placeholder="@lang('Price')" required>
                                                    </td>
                                                    <td>
                                                        <input type="number" step=".01" name="sub_total[]" class="form-control sub_total" value="{{ old('sub_total')[$key] }}" placeholder="@lang('Sub Total')" readonly>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-info m-add"><i class="fas fa-plus"></i></button>
                                                        <button type="button" class="btn btn-info m-remove"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            @foreach ($invoice->invoiceItems as $invoiceItem)
                                                <tr>
                                                    <td>
                                                        <select name="account_name[]" class="form-control select2" required>
                                                            <option value="">--@lang('Select')--</option>
                                                            @foreach ($accountHeaders as $accountHeader)
                                                                <option value="{{ $accountHeader->name }}" @if($invoiceItem->account_name == $accountHeader->name) selected @endif>{{ $accountHeader->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <textarea name="description[]" class="form-control" rows="1" placeholder="@lang('Description')">{{ $invoiceItem->description }}</textarea>
                                                    </td>
                                                    <td>
                                                        <input type="number" step=".01" name="quantity[]" class="form-control quantity" value="{{ $invoiceItem->quantity }}" placeholder="@lang('Quantity')" required>
                                                    </td>
                                                    <td>
                                                        <input type="number" step=".01" name="price[]" class="form-control price" value="{{ $invoiceItem->price }}" placeholder="@lang('Price')" required>
                                                    </td>
                                                    <td>
                                                        <input type="number" step=".01" name="sub_total[]" class="form-control sub_total" value="{{ $invoiceItem->total }}" placeholder="@lang('Sub Total')" readonly>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-info m-add"><i class="fas fa-plus"></i></button>
                                                        <button type="button" class="btn btn-info m-remove"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                    <tbody id="invoice">
                                        <tr>
                                            <td>
                                                <select name="account_name[]" class="form-control select2" required>
                                                    <option value="">--@lang('Select')--</option>
                                                    @foreach ($accountHeaders as $accountHeader)
                                                        <option value="{{ $accountHeader->name }}">{{ $accountHeader->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <textarea name="description[]" class="form-control" rows="1" placeholder="@lang('Description')"></textarea>
                                            </td>
                                            <td>
                                                <input type="number" step=".01" name="quantity[]" class="form-control quantity" value="" placeholder="@lang('Quantity')" required>
                                            </td>
                                            <td>
                                                <input type="number" step=".01" name="price[]" class="form-control price" value="" placeholder="@lang('Price')" required>
                                            </td>
                                            <td>
                                                <input type="number" step=".01" name="sub_total[]" class="form-control sub_total" value="0.00" placeholder="@lang('Sub Total')" readonly>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-info m-add"><i class="fas fa-plus"></i></button>
                                                <button type="button" class="btn btn-info m-remove"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tbody>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td class="ambitious-right">@lang('Total')</td>
                                            <td>
                                                <input type="number" step=".01" name="total" class="form-control total" value="{{ old('total', $invoice->total) }}" placeholder="@lang('Total')" readonly>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td class="text-right">@lang('Discount')</td>
                                            <td class="text-right">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                    <input type="number" step=".01" name="discount_percentage" value="{{ old('discount_percentage', $invoice->discount_percentage) }}" class="form-control discount_percentage" placeholder="%">
                                                </div>
                                            </td>
                                            <td>
                                                <input type="number" step=".01" name="total_discount" class="form-control discount" value="{{ old('total_discount', $invoice->total_discount) }}" placeholder="@lang('Total Discount')">
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td class="text-right">@lang('Vat')</td>
                                            <td class="text-right">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                    <input type="number" step=".01" name="vat_percentage" value="{{ old('vat_percentage', $invoice->vat_percentage) }}" class="form-control vat_percentage" placeholder="%">
                                                </div>
                                            </td>
                                            <td>
                                                <input type="number" step=".01" name="total_vat" class="form-control vat" value="{{ old('total_vat', $invoice->total_vat) }}" placeholder="@lang('Total Discount')">
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td class="ambitious-right">@lang('Grand Total')</td>
                                            <td>
                                                <input type="number" step=".01" name="grand_total" class="form-control grand_total" value="{{ old('grand_total', $invoice->grand_total) }}" placeholder="@lang('Grand Total')" readonly>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td class="ambitious-right">@lang('Paid')</td>
                                            <td>
                                                <input type="number" step=".01" name="paid" class="form-control paid" value="{{ old('paid', $invoice->paid) }}" placeholder="@lang('Paid')">
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td class="ambitious-right">@lang('Due')</td>
                                            <td>
                                                <input type="number" step=".01" name="due" class="form-control due" value="{{ old('due', $invoice->due) }}" placeholder="@lang('Due')" readonly>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-3 col-form-label"></label>
                                <div class="col-md-8">
                                    <input type="submit" value="{{ __('Submit') }}" class="btn btn-outline btn-info btn-lg"/>
                                    <a href="{{ route('invoices.index') }}" class="btn btn-outline btn-warning btn-lg">{{ __('Cancel') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('footer')
    <script src="{{ asset('assets/js/custom/invoice.js') }}"></script>
@endpush
