@extends('layouts.nav')

@section('content')
<x-container>

    <div class="d-flex justify-content-center mb-2">
      <a href="{{ route('backoffice-home') }}" class="btn btn-dark col-lg-3 col-md-4 col-sm-4 col-6 text-white me-2">
          <i class="fas fa-arrow-alt-circle-left"></i>
          Retour
      </a>
      <a class="btn btn-success col-lg-3 col-md-4 col-sm-4 col-6" href="{{ route('contact.edit', $contact->id) }}">
        <i class="fas fa-edit me-1"></i>
        Modifier les infos de contact
      </a>
    </div>

    <x-card title="Informations de contact">
        <div class="card-body">
            <p class="h3 pt-2 pb-2">Informations de contact</p>
    
            <table class="table table-striped">
                <thead>
                    <tr>
                      <th scope="col"></th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                <tbody>
                  <tr>
                    <th scope="row">Email</th>
                    <td>{{ $contact->email }}</td>
                  </tr>
                  <tr>
                    <th scope="row">Téléphone</th>
                    <?php $phone_with_space = chunk_split($contact->phone, 2, ' '); ?>
                    <td>{{ $phone_with_space }}</td>
                    
                  </tr>
                  <tr>
                    <th scope="row">Adresse</th>
                    <td>{{ $contact->address }} / {{ $contact->cp }} / {{ $contact->city }} </td>
                  </tr>
    
                </tbody>
            </table>
        </div> 
        </x-card>
</x-container>
@endsection
