<form method="POST" class="form-horizontal" action="{{ route('lab.exams.covid19.update', $covid19) }}">
    @csrf
    @method('POST')

    <div class="form-row">
        <fieldset class="form-group col-md-2">
            <label for="for_run">Run (sin digito)</label>
            <input type="text" class="form-control" name="run" id="for_run"
                value="{{ $covid19->run }}">
        </fieldset>

        <fieldset class="form-group col-md-1">
            <label for="for_dv">Digito</label>
            <input type="text" class="form-control" name="dv" id="for_dv"
                value="{{ $covid19->dv }}">
        </fieldset>

        <fieldset class="form-group col-1 col-md-1">
            <label for="">&nbsp;</label>
            <span class="form-control-plaintext"> </span>
        </fieldset>

        <fieldset class="form-group col-md-2">
            <label for="for_other_identification">Otra identificación</label>
            <input type="text" class="form-control" name="other_identification"
                id="for_other_identification" placeholder="Extranjeros"
                value="{{ $covid19->other_identification }}">
        </fieldset>

    </div>
    <div class="form-row">

        <fieldset class="form-group col-md-3">
            <label for="for_name">Nombre *</label>
            <input type="text" class="form-control" name="name" id="for_name"
                required value="{{ $covid19->name }}">
        </fieldset>

        <fieldset class="form-group col-md-2">
            <label for="for_fathers_family">Apellido Paterno *</label>
            <input type="text" class="form-control" name="fathers_family"
                id="for_fathers_family" required value="{{ $covid19->fathers_family }}">
        </fieldset>

        <fieldset class="form-group col-md-2">
            <label for="for_mothers_family">Apellido Materno</label>
            <input type="text" class="form-control" name="mothers_family"
                id="for_mothers_family" value="{{ $covid19->mothers_family }}">
        </fieldset>

        <fieldset class="form-group col-6 col-md-2">
            <label for="for_gender">Genero *</label>
            <select name="gender" id="for_gender" class="form-control" required>
                <option value=""></option>
                <option value="male">Masculino</option>
                <option value="female">Femenino</option>
                <option value="other">Otro</option>
                <option value="unknown">Desconocido</option>
            </select>
        </fieldset>

        <fieldset class="form-group col-6 col-md-2">
            <label for="for_birthday">Fecha Nacimiento *</label>
            <input type="date" class="form-control" id="for_birthday"
                name="birthday" required value="{{ $covid19->birthday->format('Y-m-d') }}">
        </fieldset>

    </div>

    <hr>

    <div class="form-row">

        <fieldset class="form-group col-md-3">
            <label for="for_email">Email</label>
            <input type="text" class="form-control" name="email" id="for_email"
                value="{{ $covid19->email }}">
        </fieldset>

        <fieldset class="form-group col-md-2">
            <label for="for_telephone">Telefono</label>
            <input type="text" class="form-control" name="telephone"
                id="for_telephone" value="{{ $covid19->telephone }}">
        </fieldset>

        <fieldset class="form-group col-md-4">
            <label for="for_address">Dirección</label>
            <input type="text" class="form-control" name="address"
                id="for_address" value="{{ $covid19->address }}">
        </fieldset>

        <fieldset class="form-group col-12 col-md-3">
            <label for="regiones_demo">Región *</label>
            <select class="form-control" name="region_id_demo" id="regiones_demo">
                <option>Seleccione Región</option>
                @foreach ($regions as $key => $region)
                    <option value="{{$region->id}}" {{(old('region_id') == $region->id) ? 'selected' : '' }} >{{$region->name}}</option>
                @endforeach
            </select>
        </fieldset>

        <fieldset class="form-group col-12 col-md-3">
            <label for="for_commune_id">Comuna *</label>
            <select class="form-control" name="commune_id" id="for_commune_id" required></select>
        </fieldset>


    </div>

    <hr>

    <div class="form-row">

        <fieldset class="form-group col-12 col-md-3">
            <label for="regiones">Región Origen *</label>
            <select class="form-control" name="region_id" id="regiones">
                <option>Seleccione Región</option>
                @foreach ($regions as $key => $region)
                    <option value="{{$region->id}}" {{(old('region_id') == $region->id) ? 'selected' : '' }} >{{$region->name}}</option>
                @endforeach
            </select>
        </fieldset>


        <fieldset class="form-group col-12 col-md-3">
            <label for="for_origin_commune">Comuna Origen *</label>
            <select class="form-control" name="origin_commune" id="for_origin_commune" required></select>
        </fieldset>

        <fieldset class="form-group col-12 col-md-3">
            <label for="for_establishment_id">Establecimiento Origen *</label>
            <select class="form-control" name="establishment_id" id="for_establishment_id" required></select>
        </fieldset>

        <fieldset class="form-group col-6 col-md-3">
            <label for="for_sample_type">Tipo de Muestra *</label>
            <select name="sample_type" id="for_sample_type" class="form-control" required>
                <option value=""></option>
                <option value="TÓRULAS NASOFARÍNGEAS">TORULAS NASOFARINGEAS</option>
                <option value="ESPUTO">ESPUTO</option>
                <option value="TÓRULAS NASOFARÍNGEAS/ESPUTO">TÓRULAS NASOFARÍNGEAS/ESPUTO</option>
                <option value="ASPIRADO NASOFARÍNGEO">ASPIRADO NASOFARÍNGEO</option>
            </select>
        </fieldset>

        <fieldset class="form-group col-3">
            <label for="for_sample_at">Fecha de muestra *</label>
            <input type="datetime-local" class="form-control" name="sample_at"
                id="for_sample_at" required value="{{ $covid19->sample_at->format('Y-m-d\TH:i:s') }}">
        </fieldset>

    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>

</form>
