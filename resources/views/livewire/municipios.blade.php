<div class="row">
    <div class="col-sm-12 col-xl-6 m-b-30">
        <div class="form-group">
            <label for="type_contract_id">Departamento</label>
            
            <select wire:model="departamento" id="select2-departamento" name="depto"
            class="form-control{{ $errors->has('depto') ? ' is-invalid' : '' }}">
                <option value="">-- Seleccionar --</option>
                @foreach ($departamentos as $item)
                    <option value="{{ $item->id }}"
                        {{ old('depto') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                {{ $errors->first('depto') }}
            </div>
        </div>
    </div>

    @if (!is_null($ciudades))

        <div class="col-sm-12 col-xl-6 m-b-30">
            <div class="form-group">
                <label for="municipality_id">Municipio<span class="text-danger">*</span></label>
                <select wire:model="ciudad" id="select2-ciudad" name="municipality_id" 
                class="form-control{{ $errors->has('municipality_id') ? ' is-invalid' : '' }}">
                    <option value="">-- Seleccionar --</option>
                    @foreach ($ciudades as $item)
                        <option value="{{ $item->id }}"
                            {{ old('municipality_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    {{ $errors->first('municipality_id') }}
                </div>
            </div>
        </div>

    @endif

</div>
