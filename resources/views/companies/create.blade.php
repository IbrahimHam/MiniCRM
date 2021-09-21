<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Comapnies') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="pull-left mb-2">
                <h3>Add Company</h3>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                @if(session('status'))
            <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
            </div>
            @endif

            <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <label for="Company Name">Company Name:</label>
                    <input name="name" value="{{ old('name') }}" type="name" class="form-control" placeholder="Company Name">
                    @error('name')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="Company Email">Company Email:</label>
                    <input name="email" value="{{ old('email') }}" type="email" class="form-control" placeholder="Comapny Email" aria-describedby="emailHelp">
                    @error('email')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="Company Logo">Company Logo:</label>
                    <input name="logo" value="{{ old('logo') }}" type="file" class="form-control" placeholder="Company Logo">
                    @error('logo')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="Company Website">Company Website:</label>
                    <input name="website" value="{{ old('website') }}" type="text" class="form-control" placeholder="Company Website">
                    @error('website')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</x-app-layout>
