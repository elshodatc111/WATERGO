@extends('layout.layout')
@section('title', "Xaydavchilar")
@section('content')

    <div class="pagetitle">
        <h1>Xaydavchilar</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bosh sahifa</a></li>
                <li class="breadcrumb-item active">Xaydavchilar</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Xaydavchilar</h2>
                <div class="table-responsive pt-2">
                    <table class="table table-bordered table-striped" style="font-size: 14px">
                        <thead>
                            <tr class="text-center">
                                <th>ID</th>
                                <th>Xaydovchilar</th>
                                <th>Naqt summa</th>
                                <th>Karta summa</th>
                                <th>Bank summa</th> 
                                <th>Tayyor maxsulotlar</th> 
                                <th>Bosh idishlar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($currer as $item)
                                <tr class="text-center">
                                    <td>{{ $loop->index+1 }}</td>
                                    <td style="text-align: left"><a href="{{ route('users_show',$item->user_id) }}">{{ $item->user->name }}</a></td>
                                    <td>{{ number_format($item->cash, 0, '.', ' ') }} UZS</td>
                                    <td>{{ number_format($item->card, 0, '.', ' ') }} UZS</td>
                                    <td>{{ number_format($item->bank, 0, '.', ' ') }} UZS</td>
                                    <td>{{ number_format($item->full_contaner, 0, '.', ' ') }}</td>
                                    <td>{{ number_format($item->empty_contaner, 0, '.', ' ') }}</td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="7">Ma'lumot mavjud emas</td>   
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot class="text-center">
                            <tr>
                                <th></th>
                                <th></th>
                                <th>{{ number_format($res['cash'], 0, '.', ' ') }} UZS</th>
                                <th>{{ number_format($res['card'], 0, '.', ' ') }} UZS</th>
                                <th>{{ number_format($res['bank'], 0, '.', ' ') }} UZS</th> 
                                <th>{{ number_format($res['full_contaner'], 0, '.', ' ') }}</th> 
                                <th>{{ number_format($res['empty_contaner'], 0, '.', ' ') }}</th> 
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
    
@endsection