@extends('kafaa.layout.masterApp')

@section('pageTitle', isset($project) ? 'تعديل مشروع' : 'مشروع جديد')
@section('pageDescription', 'أضف مشاريعك لعرضها في ملفك الشخصي')

@section('addAndEditProject')
    <div class="row m-1">
        <div class="col-12 p-2">
            <div class="card shade" style="border-radius: 16px; border: 1px solid rgba(137,44,220,0.1);">
                <div class="card-body p-4">
                    <h4 style="font-weight:bold; color:#2d114e;">
                        <i class="fas {{ isset($project) ? 'fa-pen-to-square' : 'fa-circle-plus' }} mr-2" style="color:#892CDC;"></i>
                        {{ isset($project) ? 'تعديل المشروع' : 'إضافة مشروع جديد' }}
                    </h4>
                    <hr style="border-top:1px solid rgba(137,44,220,0.1);">

                    @if ($errors->any())
                        <div class="alert alert-danger" style="border-radius:10px;">
                            <ul class="mb-0 pr-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ isset($project) ? route('kafaa.projects.update', $project->id) : route('kafaa.projects.store') }}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($project))
                            @method('PUT')
                        @endif

                        {{-- Image --}}
                        <div class="form-group">
                            <label for="customFile" style="font-weight:bold; color:#4d3a7d;">
                                صورة المشروع @if(!isset($project))<span class="text-danger">*</span>@endif
                            </label>
                            @if (isset($project) && $project->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}"
                                         style="max-width:160px; border-radius:10px; box-shadow:0 6px 16px rgba(0,0,0,.1);">
                                </div>
                            @endif
                            <input type="file" name="image" class="form-control-file" id="customFile" accept="image/*">
                            <small class="form-text text-muted">صيغ مدعومة: JPG, PNG, GIF — بحد أقصى 2 ميجابايت.</small>
                        </div>

                        {{-- Title --}}
                        <div class="form-group">
                            <label for="ProjectTitle" style="font-weight:bold; color:#4d3a7d;">عنوان المشروع <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" id="ProjectTitle"
                                   placeholder="مثال: متجر إلكتروني متكامل" value="{{ old('title', $project->title ?? '') }}">
                        </div>

                        {{-- Date --}}
                        <div class="form-group">
                            <label for="date" style="font-weight:bold; color:#4d3a7d;">تاريخ المشروع</label>
                            <input type="date" name="date" class="form-control" id="date"
                                   value="{{ old('date', isset($project->date) ? \Carbon\Carbon::parse($project->date)->format('Y-m-d') : '') }}">
                        </div>

                        {{-- Technologies --}}
                        <div class="form-group">
                            <label for="technologies" style="font-weight:bold; color:#4d3a7d;">التقنيات المستخدمة</label>
                            <input type="text" name="technologies" class="form-control" id="technologies"
                                   placeholder="مثال: Laravel، Vue.js، MySQL" value="{{ old('technologies', $project->technologies ?? '') }}">
                            <small class="form-text text-muted">اكتب التقنيات مفصولة بفاصلة.</small>
                        </div>

                        {{-- Link --}}
                        <div class="form-group">
                            <label for="linkProject" style="font-weight:bold; color:#4d3a7d;">رابط المشروع</label>
                            <input type="url" name="link" class="form-control" id="linkProject"
                                   placeholder="https://example.com" value="{{ old('link', $project->link ?? '') }}">
                            <small class="form-text text-muted">اختياري — رابط المشروع المباشر أو مستودع GitHub.</small>
                        </div>

                        {{-- Description --}}
                        <div class="form-group">
                            <label for="description" style="font-weight:bold; color:#4d3a7d;">الوصف <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="description" id="description" rows="4"
                                      placeholder="نبذة مختصرة عن المشروع وما قمت به فيه...">{{ old('description', $project->description ?? '') }}</textarea>
                        </div>

                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn text-white" style="background:linear-gradient(135deg,#892CDC,#BC6FF1); border:none; border-radius:10px; font-weight:bold; padding:.6rem 2rem;">
                                <i class="fas fa-save mr-1"></i>{{ isset($project) ? 'حفظ التعديلات' : 'إضافة المشروع' }}
                            </button>
                            <a href="{{ route('kafaa.projects.index') }}" class="btn btn-secondary mr-2" style="border-radius:10px; font-weight:bold; padding:.6rem 1.5rem;">
                                <i class="fas fa-arrow-right mr-1"></i>رجوع
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
