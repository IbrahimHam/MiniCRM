<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Comapnies') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="pull-left">
                </div>
                <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('companies.create') }}"> Create Company</a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                @if ($message = Session::get('status'))
                <div class="alert alert-secondary">
                    <p>{{ $message }}</p>
                </div>
                @endif

                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Logo</th>
                            <th scope="col">Website</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($companies as $company)
                            <tr>
                                <td>{{ $company->id }}</td>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->email }}</td>

                                <td><img  src="{{ asset('storage/'.$company->logo) }}" height="50px" alt="" title=""></img></td>
                                <td>{{ $company->website }}</td>
                                <td>
                                    <form action="{{ route('companies.destroy',$company->id) }}" method="Post">
                                        <a class="btn btn-primary" href="{{ route('companies.edit',$company->id) }}">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>



