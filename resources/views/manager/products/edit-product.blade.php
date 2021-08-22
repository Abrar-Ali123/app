@extends('manager.layouts.app', ['title' => 'Edit Product'])

@section('css')
    <link href="{{asset('assets/libs/dropzone/dropzone.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/libs/dropify/dropify.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/libs/summernote/summernote.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')

    <!-- Start Content-->
    <div class="container-fluid">
        <x-alert></x-alert>

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('manager.dashboard')}}">{{env('APP_NAME')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                    href="{{route('manager.products.index')}}">{{__('manager.product')}}</a></li>
                            <li class="breadcrumb-item active">{{__('manager.edit')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('manager.edit_product')}}</h4>
                </div>
            </div>
        </div>

        <form action="{{route('manager.products.update',['id'=>$product['id']])}}" method="post" id="product-form"
              enctype="multipart/form-data">
            @csrf
            {{method_field('PATCH')}}

            <div class="row">

                <div class="col-lg-6">
                    <!-- end col-->

                    <div class="card-box">
                        <div class="row bg-light py-1 px-3">
                            <h5 class="text-uppercase inline">{{__('manager.product_images')}} </h5>
                            <div class="col text-right">
                                <a
                                    href="{{route('manager.product-images.edit',['id'=>$product['id']])}}"
                                    style="font-size: 20px"> <i
                                        class="mdi mdi-pencil"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-box">
                        <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">{{__('manager.general')}}</h5>

                        <div class="form-group custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="active"
                                   name="active" {{$product->active ? "checked" : ""}}>
                            <label class="custom-control-label" for="active">{{__('manager.active')}}
                                ({{__('manager.you_can_disable_or_enable_this_product')}})</label>
                        </div>

                        <div class="form-group mb-3">
                            <label for="name">{{__('manager.product_name')}} <span class="text-danger">*</span></label>
                            <input type="text" id="name" name="name"
                                   class="form-control @if($errors->has('name')) is-invalid @endif"
                                   placeholder="e.g : Apple iMac" value="{{$product->name}}">
                            @if($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>


                        <div class="form-group mb-3">
                            <label for="category">{{__('manager.category')}} <span class="text-danger">*</span></label>
                            <select class="form-control" name="category" id="category">
                                <option disabled>Select</option>
                                @foreach($categories as $category)
                                    <optgroup label="{{$category->title}}">
                                        @foreach($category->subCategories as $sub_category)
                                            <option value="{{$sub_category->id}}" @if($sub_category->id==$product->sub_category_id) selected @endif>{{$sub_category->title}}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- end card-box -->

                </div>

                <div class="col-lg-6">


                    <div class="card-box">
                        <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">{{__('manager.meta_data')}}</h5>


                        <div class="form-group mb-3">
                            <label for="summernote">{{__('manager.description')}}</label>
                            <textarea id="summernote" name="description"
                                      class="@if($errors->has('description')) is-invalid @endif">{{$product->description}}</textarea>
                            @if($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>


                        <div class="form-group mb-3">
                            <label for="offer">{{__('manager.offer')}} (%)</label>
                            <div class="input-group">

                                <input type="number" min="0" max="100" step="1"
                                       class="form-control @if($errors->has('offer')) is-invalid @endif" name="offer"
                                       id="offer" value="{{$product->offer}}"
                                       placeholder="Offer">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon1">%</span>
                                </div>
                                @if($errors->has('offer'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('offer') }}</strong>
                                </span>
                                @endif
                            </div>

                        </div>


                    </div>
                    <!-- end card-box -->
                </div> <!-- end col -->

                <div class="col-lg-12">

                    <div class="card-box">
                        <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">{{__('manager.items')}}</h5>

                        <div class="text-danger" id="product-item-wrapper-error"></div>
                        <div id="product-item-wrapper" class="mt-2">
                        </div>
                        <div class="mt-2">
                            <button type="button" id="add-item"
                                    class="btn w-sm btn-primary waves-effect waves-light">{{__('manager.add_item')}}</button>
                        </div>

                    </div>
                    <!-- end card-box -->
                </div>


                <div class="col-12">
                    <div class="text-right mb-3">
                        <button type="button" class="btn w-sm btn-light waves-effect">{{__('manager.cancel')}}</button>
                        <button type="button" id="submitBtn"
                                class="btn w-sm btn-success waves-effect waves-light">{{__('manager.save')}}</button>
                    </div>
                </div> <!-- end col-->
            </div>
        </form>

    </div>

@endsection

@section('script')
    <script>

        class Item {
            itemFeatureWrapper;

            featuresList = ["Color", "Size", "Gram", "Other"];
            inputType = ["color", "text", "number", "text"];

            constructor() {
                this.price = 0;
                this.features = [];
                this.quantity = 0;
                this.revenue = 0;
                this.id = -1;
            }

            createView = () => {

                const self = this;
                const itemRow = document.createElement("div");
                itemRow.classList.add('row');

                const itemColFeatureWrapper = document.createElement('div');
                itemColFeatureWrapper.classList.add('col-lg-8');

                this.itemFeatureWrapper = document.createElement('div');
                this.itemFeatureWrapper.classList.add('row');

                itemColFeatureWrapper.appendChild(this.itemFeatureWrapper);

                this.addFeature();

                const itemColAddBtn = document.createElement("div");
                itemColAddBtn.classList.add('col-auto');

                const featureAddBtn = document.createElement('button');
                featureAddBtn.type = "button";
                featureAddBtn.id = "add-feature";
                featureAddBtn.innerHTML = "Add Feature";
                featureAddBtn.classList.add('btn', 'w-sm', 'btn-primary', 'waves-effect', 'waves-light', 'mb-2');

                itemColAddBtn.appendChild(featureAddBtn);

                const itemRowMetaData = document.createElement("div");
                itemRowMetaData.classList.add('col-lg-3');

                const formGroupInputPrice = document.createElement('div');
                formGroupInputPrice.classList.add('form-group');

                const formGroupLabelPrice = document.createElement('label');
                formGroupLabelPrice.innerHTML = "{{__('manager.item_price')}}";
                formGroupLabelPrice.for = "price";

                const inputGroupInputPrice = document.createElement('div');
                inputGroupInputPrice.classList.add('input-group');

                const inputGroupPrependInputPrice = document.createElement('div');
                inputGroupPrependInputPrice.classList.add('input-group-prepend');

                const inputGroupTextInputPrice = document.createElement('span');
                inputGroupTextInputPrice.classList.add('input-group-text');
                inputGroupTextInputPrice.innerHTML = "{{\App\Helpers\AppSetting::$currencySign}}";

                const inputPrice = document.createElement('input');
                inputPrice.type = "number";
                inputPrice.min = "1";
                inputPrice.step = "1";
                inputPrice.classList.add('form-control');
                inputPrice.name = "price";
                inputPrice.placeholder = "{{__('manager.item_price')}}";

                inputGroupPrependInputPrice.appendChild(inputGroupTextInputPrice);

                inputGroupInputPrice.appendChild(inputGroupPrependInputPrice);
                inputGroupInputPrice.appendChild(inputPrice);

                formGroupInputPrice.appendChild(formGroupLabelPrice);
                formGroupInputPrice.appendChild(inputGroupInputPrice);

                itemRowMetaData.appendChild(formGroupInputPrice);

                const formGroupInputRevenue = document.createElement('div');
                formGroupInputRevenue.classList.add('form-group');

                const formGroupLabelRevenue = document.createElement('label');
                formGroupLabelRevenue.innerHTML = "{{__('manager.revenue_as_per_single_item')}}";
                formGroupLabelRevenue.for = "revenue";

                const inputGroupInputRevenue = document.createElement('div');
                inputGroupInputRevenue.classList.add('input-group');

                const inputGroupPrependInputRevenue = document.createElement('div');
                inputGroupPrependInputRevenue.classList.add('input-group-prepend');

                const inputGroupTextInputRevenue = document.createElement('span');
                inputGroupTextInputRevenue.classList.add('input-group-text');
                inputGroupTextInputRevenue.innerHTML = "{{\App\Helpers\AppSetting::$currencySign}}";

                const inputRevenue = document.createElement('input');
                inputRevenue.type = "number";
                inputRevenue.min = "1";
                inputRevenue.step = "1";
                inputRevenue.classList.add('form-control');
                inputRevenue.name = "revenue";
                inputRevenue.placeholder = "{{__('manager.revenue_as_per_single_item')}}";

                inputGroupPrependInputRevenue.appendChild(inputGroupTextInputRevenue);

                inputGroupInputRevenue.appendChild(inputGroupPrependInputRevenue);
                inputGroupInputRevenue.appendChild(inputRevenue);

                formGroupInputRevenue.appendChild(formGroupLabelRevenue);
                formGroupInputRevenue.appendChild(inputGroupInputRevenue);

                itemRowMetaData.appendChild(formGroupInputRevenue);

                const formGroupInputQty = document.createElement('div');
                formGroupInputQty.classList.add('form-group');

                const formGroupLabelQty = document.createElement('label');
                formGroupLabelQty.innerHTML = "{{__('manager.quantity')}}";
                formGroupLabelQty.for = "quantity";

                const inputQty = document.createElement('input');
                inputQty.type = "number";
                inputQty.min = "1";
                inputQty.step = "1";
                inputQty.classList.add('form-control');
                inputQty.name = "quantity";
                inputQty.placeholder = "{{__('manager.quantity')}}";

                formGroupInputQty.appendChild(formGroupLabelQty);
                formGroupInputQty.appendChild(inputQty);

                itemRowMetaData.appendChild(formGroupInputQty);

                itemRow.appendChild(itemColFeatureWrapper);
                itemRow.appendChild(itemColAddBtn);
                itemRow.appendChild(itemRowMetaData);

                featureAddBtn.addEventListener('click', function () {
                    self.addFeature();
                });

                inputPrice.addEventListener('input', function () {
                    self.price = this.value;
                });

                inputQty.addEventListener('input', function () {
                    self.quantity = this.value;
                });

                inputRevenue.addEventListener('input', function () {
                    self.revenue = this.value;
                });

                return itemRow;
            }

            addFeature() {

                if (this.validateAddFeature()) {
                    const feature = new Feature(this.features, this.featuresList, this.inputType);
                    const itemColFeature = feature.createView();
                    this.features.push(feature);
                    this.itemFeatureWrapper.appendChild(itemColFeature);
                }
            }

            addFeatureWithData(element) {
                const feature = new Feature(this.features, this.featuresList, this.inputType);
                const itemColFeature = feature.createViewFromData(element.feature, element.value);
                this.features.push(feature);
                this.itemFeatureWrapper.appendChild(itemColFeature);
            }

            validateAddFeature() {
                for (var i = 0; i < this.features.length; i++) {
                    if (!this.features[i].value) {
                        ProductItem.setAlert('Please fill value');
                        return false;
                    }
                }
                return true;
            }

            getData() {
                let featureList = [];
                for (let i = 0; i < this.features.length; i++) {
                    featureList.push(this.features[i].getData());

                }
                return {
                    "product_item_features": featureList,
                    "price": this.price,
                    "quantity": this.quantity,
                    "revenue": this.revenue,
                    "id":this.id
                }


            }

            createViewFromData(id,features, price, revenue, quantity) {
                this.price = price;
                this.id = id;
                this.quantity = quantity;
                this.revenue = revenue;

                const self = this;
                const itemRow = document.createElement("div");
                itemRow.classList.add('row');

                const itemColFeatureWrapper = document.createElement('div');
                itemColFeatureWrapper.classList.add('col-lg-8');

                this.itemFeatureWrapper = document.createElement('div');
                this.itemFeatureWrapper.classList.add('row');

                itemColFeatureWrapper.appendChild(this.itemFeatureWrapper);

                features.forEach((element) => {
                    this.addFeatureWithData(element);
                });

                const itemColAddBtn = document.createElement("div");
                itemColAddBtn.classList.add('col-auto');



                const itemRowMetaData = document.createElement("div");
                itemRowMetaData.classList.add('col-lg-3');

                const formGroupInputPrice = document.createElement('div');
                formGroupInputPrice.classList.add('form-group');

                const formGroupLabelPrice = document.createElement('label');
                formGroupLabelPrice.innerHTML = "{{__('manager.item_price')}}";
                formGroupLabelPrice.for = "price";

                const inputGroupInputPrice = document.createElement('div');
                inputGroupInputPrice.classList.add('input-group');

                const inputGroupPrependInputPrice = document.createElement('div');
                inputGroupPrependInputPrice.classList.add('input-group-prepend');

                const inputGroupTextInputPrice = document.createElement('span');
                inputGroupTextInputPrice.classList.add('input-group-text');
                inputGroupTextInputPrice.innerHTML = "{{\App\Helpers\AppSetting::$currencySign}}";

                const inputPrice = document.createElement('input');
                inputPrice.type = "number";
                inputPrice.min = "1";
                inputPrice.step = "1";
                inputPrice.value = price;
                inputPrice.classList.add('form-control');
                inputPrice.name = "price";
                inputPrice.placeholder = "{{__('manager.item_price')}}";

                inputGroupPrependInputPrice.appendChild(inputGroupTextInputPrice);

                inputGroupInputPrice.appendChild(inputGroupPrependInputPrice);
                inputGroupInputPrice.appendChild(inputPrice);

                formGroupInputPrice.appendChild(formGroupLabelPrice);
                formGroupInputPrice.appendChild(inputGroupInputPrice);

                itemRowMetaData.appendChild(formGroupInputPrice);


                const formGroupInputRevenue = document.createElement('div');
                formGroupInputRevenue.classList.add('form-group');

                const formGroupLabelRevenue = document.createElement('label');
                formGroupLabelRevenue.innerHTML = "{{__('manager.revenue_as_per_single_item')}}";
                formGroupLabelRevenue.for = "revenue";


                const inputGroupInputRevenue = document.createElement('div');
                inputGroupInputRevenue.classList.add('input-group');

                const inputGroupPrependInputRevenue = document.createElement('div');
                inputGroupPrependInputRevenue.classList.add('input-group-prepend');

                const inputGroupTextInputRevenue = document.createElement('span');
                inputGroupTextInputRevenue.classList.add('input-group-text');
                inputGroupTextInputRevenue.innerHTML = "{{\App\Helpers\AppSetting::$currencySign}}";

                const inputRevenue = document.createElement('input');
                inputRevenue.type = "number";
                inputRevenue.min = "1";
                inputRevenue.step = "1";
                inputRevenue.classList.add('form-control');
                inputRevenue.name = "revenue";
                inputRevenue.value = revenue;
                inputRevenue.placeholder = "{{__('manager.revenue_as_per_single_item')}}";

                inputGroupPrependInputRevenue.appendChild(inputGroupTextInputRevenue);

                inputGroupInputRevenue.appendChild(inputGroupPrependInputRevenue);
                inputGroupInputRevenue.appendChild(inputRevenue);

                formGroupInputRevenue.appendChild(formGroupLabelRevenue);
                formGroupInputRevenue.appendChild(inputGroupInputRevenue);

                itemRowMetaData.appendChild(formGroupInputRevenue);


                const formGroupInputQty = document.createElement('div');
                formGroupInputQty.classList.add('form-group');

                const formGroupLabelQty = document.createElement('label');
                formGroupLabelQty.innerHTML = "{{__('manager.quantity')}}";
                formGroupLabelQty.for = "quantity";


                const inputQty = document.createElement('input');
                inputQty.type = "number";
                inputQty.min = "1";
                inputQty.step = "1";
                inputQty.classList.add('form-control');
                inputQty.name = "quantity";
                inputQty.value = quantity;
                inputQty.placeholder = "{{__('manager.quantity')}}";

                formGroupInputQty.appendChild(formGroupLabelQty);
                formGroupInputQty.appendChild(inputQty);

                itemRowMetaData.appendChild(formGroupInputQty);

                itemRow.appendChild(itemColFeatureWrapper);
                itemRow.appendChild(itemColAddBtn);
                itemRow.appendChild(itemRowMetaData);

                inputPrice.addEventListener('input', function () {
                    self.price = this.value;
                });

                inputQty.addEventListener('input', function () {
                    self.quantity = this.value;
                });

                inputRevenue.addEventListener('input', function () {
                    self.revenue = this.value;
                });

                return itemRow;


            }

        }

        class Feature {

            constructor(features, featuresList, inputType) {
                this.features = features;
                this.value = "#000000";
                this.featuresList = featuresList;
                this.feature = featuresList[0];
                this.inputType = inputType;
            }

            createView() {


                const self = this;


                const itemColFeature = document.createElement("div");
                itemColFeature.classList.add('col-lg-3', 'mb-2');

                const itemSelectFeature = document.createElement('select');
                itemSelectFeature.classList.add('custom-select');
                itemSelectFeature.id = "key-selector";

                const option = document.createElement('option');
                option.value = "-1";
                option.text = "Remove";
                itemSelectFeature.add(option);

                this.featuresList.forEach((element, index) => {
                    const option = document.createElement('option');
                    option.value = index.toString();
                    option.text = element;
                    if (index === 0)
                        option.selected = true;
                    itemSelectFeature.add(option);

                });

                const itemInputValue = document.createElement('input');
                itemInputValue.type = "color";
                itemInputValue.defaultValue = "#000000";
                itemInputValue.id = "value-input";
                itemInputValue.classList.add('form-control');
                itemInputValue.classList.add('mt-2');

                itemColFeature.appendChild(itemSelectFeature);
                itemColFeature.appendChild(itemInputValue);

                itemSelectFeature.addEventListener('change', (event) => {
                    if (event.target.value == -1) {
                        this.features.pop(itemColFeature);
                        itemColFeature.remove();
                    } else {
                        this.feature = this.featuresList[event.target.value];
                        if (!this.feature.localeCompare('Color')) {
                            itemInputValue.type = "color";
                        } else if (!this.feature.localeCompare('Gram')) {
                            itemInputValue.type = "number";
                            itemInputValue.min = "0";

                        } else {
                            itemInputValue.type = "text";
                        }
                    }
                })

                itemInputValue.addEventListener('input', function (e) {
                    self.value = this.value;
                });

                return itemColFeature;
            }

            getData() {
                return {
                    "feature": this.feature,
                    "value": this.value
                }
            }

            createViewFromData(feature, value) {
                this.feature = feature;
                this.value = value;
                const self = this;


                const itemColFeature = document.createElement("div");
                itemColFeature.classList.add('col-lg-3', 'mb-2');

                const itemSelectFeature = document.createElement('select');
                itemSelectFeature.disabled = true;
                itemSelectFeature.classList.add('custom-select');
                itemSelectFeature.id = "key-selector";

                const option = document.createElement('option');
                option.value = "-1";
                option.text = "Remove";
                itemSelectFeature.add(option);

                this.featuresList.forEach((element, index) => {
                    const option = document.createElement('option');
                    option.value = index.toString();
                    option.text = element;
                    if (index === this.featuresList.indexOf(feature))
                        option.selected = true;
                    itemSelectFeature.add(option);
                });

                const itemInputValue = document.createElement('input');
                itemInputValue.type = this.inputType[this.featuresList.indexOf(feature)];
                itemInputValue.defaultValue = value;
                itemInputValue.id = "value-input";
                itemInputValue.disabled = true;
                itemInputValue.classList.add('form-control');
                itemInputValue.classList.add('mt-2');

                itemColFeature.appendChild(itemSelectFeature);
                itemColFeature.appendChild(itemInputValue);

                itemSelectFeature.addEventListener('change', (event) => {
                    if (event.target.value == -1) {
                        this.features.pop(itemColFeature);
                        itemColFeature.remove();
                    } else {
                        this.feature = this.featuresList[event.target.value];
                        if (!this.feature.localeCompare('Color')) {
                            itemInputValue.type = "color";
                        } else if (!this.feature.localeCompare('Gram')) {
                            itemInputValue.type = "number";
                            itemInputValue.min = "0";

                        } else {
                            itemInputValue.type = "text";
                        }
                    }
                })

                itemInputValue.addEventListener('input', function (e) {
                    self.value = this.value;
                });

                return itemColFeature;

            }

        }

        class ProductItem {

            constructor() {
                this.items = [];
                this.itemHeaderText;
                this.productItemWrapper;
            }

            initView() {
                const self = this;
                const addItemBtn = document.getElementById('add-item');
                this.productItemWrapper = document.getElementById('product-item-wrapper');

                addItemBtn.addEventListener('click', function () {
                    self.addItem();
                });
            }

            createView() {
                this.initView();
                this.addItem();


            }

            addItem() {
                const self = this;
                if (this.validateAddItem()) {
                    const itemHeaderRow = document.createElement('div');
                    itemHeaderRow.classList.add('row');

                    const itemColHeaderText = document.createElement('div');
                    itemColHeaderText.classList.add('col-auto', 'mr-auto');

                    this.itemHeaderText = document.createElement('h4');
                    this.itemHeaderText.innerHTML = "{{__('manager.item')}}" + "-" + (this.items.length + 1).toString();
                    this.itemHeaderText.classList.add('mb-2');

                    itemColHeaderText.appendChild(this.itemHeaderText);

                    const deleteBtn = document.createElement('a');
                    deleteBtn.style.cursor = "pointer";
                    const deleteBtnText = document.createElement('h4');
                    deleteBtn.classList.add('mr-3');
                    deleteBtnText.innerHTML = "x";
                    deleteBtn.appendChild(deleteBtnText);

                    itemHeaderRow.appendChild(itemColHeaderText)
                    itemHeaderRow.appendChild(deleteBtn)

                    const horizontalRule = document.createElement('hr');
                    const item = new Item();
                    const itemRow = item.createView();
                    this.productItemWrapper.appendChild(itemHeaderRow);
                    this.productItemWrapper.appendChild(itemRow);
                    this.productItemWrapper.appendChild(horizontalRule);
                    this.items.push(item);

                    deleteBtn.addEventListener('click', function () {
                        // itemHeaderRow.remove();
                        // itemRow.remove();
                        // horizontalRule.remove();
                        // self.items.pop(item);

                    });

                } else {
                    ProductItem.setAlert('Fill value and price properly');
                }
            }

            addItemWithData(element, index) {

                const self = this;

                const itemHeaderRow = document.createElement('div');
                itemHeaderRow.classList.add('row');

                const itemColHeaderText = document.createElement('div');
                itemColHeaderText.classList.add('col-auto', 'mr-auto');

                this.itemHeaderText = document.createElement('h4');
                this.itemHeaderText.innerHTML = "{{__('manager.item')}}" + "-" + (index + 1).toString();
                this.itemHeaderText.classList.add('mb-2');

                itemColHeaderText.appendChild(this.itemHeaderText);

                const deleteBtn = document.createElement('a');
                deleteBtn.style.cursor = "pointer";
                const deleteBtnText = document.createElement('h4');
                deleteBtn.classList.add('mr-3');
                deleteBtnText.innerHTML = "x";
                deleteBtn.appendChild(deleteBtnText);

                itemHeaderRow.appendChild(itemColHeaderText)
                itemHeaderRow.appendChild(deleteBtn)

                const horizontalRule = document.createElement('hr');
                const item = new Item();
                const itemRow = item.createViewFromData(element.id,element.product_item_features, element.price, element.revenue, element.quantity);
                this.productItemWrapper.appendChild(itemHeaderRow);
                this.productItemWrapper.appendChild(itemRow);
                this.productItemWrapper.appendChild(horizontalRule);
                this.items.push(item);

                deleteBtn.addEventListener('click', function () {
                    // itemHeaderRow.remove();
                    // itemRow.remove();
                    // horizontalRule.remove();
                    // self.items.pop(item);

                });
            }

            validateAddItem() {
                console.log(this.items);
                for (let i = 0; i < this.items.length; i++) {
                    const singleItem = this.items[i];
                    if (!singleItem.validateAddFeature()) {
                        console.log(singleItem);
                        return false;
                    }
                    if (singleItem.price === 0) {
                        return false;
                    }
                }
                return true;
            }

            getData() {
                let data = [];
                for (let i = 0; i < this.items.length; i++) {
                    data.push(this.items[i].getData());

                }
                return JSON.stringify(data);
            }

            createViewWithData(productItems) {
                const self = this;
                const addItemBtn = document.getElementById('add-item');
                this.productItemWrapper = document.getElementById('product-item-wrapper');

                productItems.forEach((element, index) => {
                    this.addItemWithData(element, index);
                })

                addItemBtn.addEventListener('click', function () {
                    self.addItem();
                });

            }

            static setAlert(message) {
                const errorElement = document.getElementById('product-item-wrapper-error');
                errorElement.innerText = message;
                const element = errorElement;
                setTimeout(function () {

                    var op = 1;  // initial opacity
                    var timer = setInterval(function () {
                        if (op <= 0.1) {
                            clearInterval(timer);
                            element.innerHTML = '';
                        }
                        element.style.opacity = op;
                        element.style.filter = 'alpha(opacity=' + op * 100 + ")";
                        op -= op * 0.1;
                    }, 70);
                }, 3000);

            }
        }


        $(document).ready(function () {
            $('#summernote').summernote({
                toolbar: [
                    ['style', ['bold', 'italic']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['codeview', 'help']],
                ]
            })

            const form = document.getElementById('product-form');
            let oldItems = '{{old('items')}}'.replace(/&quot;/g, '"');
            console.log('{{old('items')}}');
            const productItem = new ProductItem();
            if (oldItems == "") {
                oldItems = JSON.parse('{{$product}}'.replace(/&quot;/g, '"'))['product_items'];
                console.log(JSON.parse('{{$product}}'.replace(/&quot;/g, '"')));
                if (oldItems != "") {
                    productItem.createViewWithData((oldItems))
                } else {
                    productItem.initView();
                }
            }else{
                productItem.createViewWithData((oldItems))
            }




            document.getElementById('submitBtn').addEventListener('click', function () {
                if (productItem.validateAddItem()) {
                    const inputItem = document.createElement('input');
                    inputItem.type = "hidden";
                    inputItem.name = "items";
                    inputItem.value = productItem.getData();
                    form.appendChild(inputItem);

                    form.submit();
                } else {
                    ProductItem.setAlert('Fill value and price properly')
                }
            });
        });
    </script>

    <script src="{{asset('assets/libs/summernote/summernote.min.js')}}"></script>

    <!-- Page js-->
    <script src="{{asset('assets/js/pages/form-summernote.init.js')}}"></script>
    <script src="{{asset('assets/libs/dropzone/dropzone.min.js')}}"></script>
    <script src="{{asset('assets/libs/dropify/dropify.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/form-fileuploads.init.js')}}"></script>
@endsection
