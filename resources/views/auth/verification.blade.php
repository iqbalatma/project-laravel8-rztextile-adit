<x-dashboard.layout :title="$title">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-file-invoice-dollar"></i>
            {{ $cardTitle }}
        </div>
        <div class="card-body">
            @if (session('resent'))
            <div class="alert alert-success" role="alert">
                A fresh verification link has been sent to your email address.
            </div>
            @endif

            Before proceeding, please check your email for a verification link. If you did not receive the email,
            <form action="{{ route('verification.resend') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="d-inline btn btn-link p-0">
                    click here to request another
                </button>.
            </form>
        </div>
    </div>




</x-dashboard.layout>
