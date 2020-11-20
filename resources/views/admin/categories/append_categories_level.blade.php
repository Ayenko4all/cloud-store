
<div class="form-group">
    <label>Select Category Level</label>
    <select name="parent_id" id="parent_id" class="form-control select2" style="width: 100%;">
        <option value="0" @if(isset($categoryData['parent_id']) && $categoryData['parent_id']==0) selected @endif>
            Main Category
        </option>
            @if(!empty($getCategories))
                @foreach($getCategories as $category)
                    <option value="{{ $category['id']}}" @if(isset($categoryData['parent_id']) && $categoryData['parent_id'] ==$category['id']) selected @endif>
                        {{ $category['category_name'] }}</option>
                    {{--SubCatrgories drop down--}}
                    @if(!empty($category['subcategories']))
                        @foreach($category['subcategories'] as $subCategory)
                            <option value="{{ $subCategory['id'] }}">&nbsp;&raquo;&nbsp;&raquo;{{ $subCategory['category_name'] }}</option>
                        @endforeach
                  @endif
                @endforeach
            @endif
    </select>
</div>
