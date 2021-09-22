<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employees') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="pull-left mb-2">
                <h3>Edit Employee</h3>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                @if(session('status'))
            <div class="alert alert-secondary mb-1 mt-1">
            {{ session('status') }}
            </div>
            @endif

            <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div class="form-group">
                    <label for="First Name">First Name:</label>
                    <input name="fname" type="name" value="{{ $employee->fname }}" class="form-control" placeholder="First Name">
                    @error('name')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="Last Name">Last Name:</label>
                    <input name="lname" type="name" value="{{ $employee->lname }}" class="form-control" placeholder="Last Name">
                    @error('email')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="Employee email">Email</label>
                    <input name="email" type="email" value="{{ $employee->email }}" class="form-control" placeholder="Email">
                    @error('email')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="Employee Phone">Phone Number</label>
                    <input name="phone" type="text" value="{{ $employee->phone }}" class="form-control" placeholder="Phone number">
                    @error('email')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Company Related:</label>
                    <select name="company_id" class="form-select" aria-label="Default select example">
                        @foreach ($companies as $company)
                            <option value="{{$company->id}}">{{$company->name}}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</x-app-layout>
