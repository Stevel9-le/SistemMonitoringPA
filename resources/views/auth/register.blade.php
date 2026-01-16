<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Monitoring PA - Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(to bottom, #e3f2fd, #bbdefb);
            font-family: 'Nunito', sans-serif;
        }
        .register-container {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }
        .register-title {
            text-align: center;
            margin-bottom: 0.5rem;
            color: #1976d2;
        }
        .register-subtitle {
            text-align: center;
            margin-bottom: 2rem;
            color: #666;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .btn-primary {
            background-color: #1976d2;
            border-color: #1976d2;
        }
        .btn-primary:hover {
            background-color: #1565c0;
            border-color: #1565c0;
        }
        .text-center a {
            color: #1976d2;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <h1 class="register-title">Sistem Monitoring PA</h1>
        <p class="register-subtitle">Create Account for Final Project System</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                       name="name" value="{{ old('name') }}" placeholder="Full Name" required autocomplete="name" autofocus>
                @error('name')
                    <div class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email">
                @error('email')
                    <div class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                       name="password" placeholder="Password" required autocomplete="new-password">
                @error('password')
                    <div class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <input type="password" class="form-control"
                       name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
            </div>

            <div class="form-group">
                <select class="form-control @error('role') is-invalid @enderror" name="role" required>
                    <option value="">Select Role</option>
                    <option value="mahasiswa">Mahasiswa (Student)</option>
                    <option value="staff">Staff</option>
                </select>
                @error('role')
                    <div class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>

            <div id="student-fields" style="display: none;">
                <div class="form-group">
                    <input type="text" class="form-control @error('student_id') is-invalid @enderror"
                           name="student_id" value="{{ old('student_id') }}" placeholder="Student ID">
                    @error('student_id')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <select class="form-control @error('department') is-invalid @enderror" name="department" id="department">
                        <option value="">Select Department</option>
                        <option value="Teknologi Informasi" {{ old('department') == 'Teknologi Informasi' ? 'selected' : '' }}>Teknologi Informasi</option>
                        <option value="Teknologi Industri" {{ old('department') == 'Teknologi Industri' ? 'selected' : '' }}>Teknologi Industri</option>
                        <option value="Bisnis dan Komunikasi" {{ old('department') == 'Bisnis dan Komunikasi' ? 'selected' : '' }}>Bisnis dan Komunikasi</option>
                    </select>
                    @error('department')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <select class="form-control @error('study_program') is-invalid @enderror" name="study_program" id="study_program">
                        <option value="">Select Study Program</option>
                    </select>
                    @error('study_program')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-lg w-100">Sign Up</button>
        </form>

        <div class="text-center mt-3">
            <p>Already have an account? <a href="{{ route('login') }}">Log in</a>.</p>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('select[name="role"]').change(function() {
                if ($(this).val() === 'mahasiswa') {
                    $('#student-fields').show();
                } else {
                    $('#student-fields').hide();
                }
            });

            const studyPrograms = {
                'Teknologi Informasi': [
                    'S1 Terapan (D4) Teknik Informatika',
                    'S1 Terapan (D4) Sistem Informasi',
                    'S1 Terapan (D4) Teknologi Rekayasa Komputer',
                    'S2 Terapan (Magister) Teknik Komputer'
                ],
                'Teknologi Industri': [
                    'S1 Terapan (D4) Teknik Listrik',
                    'S1 Terapan (D4) Teknik Elektronika',
                    'S1 Terapan (D4) Teknik Mesin',
                    'S1 Terapan (D4) Teknologi Rekayasa Mekatronika',
                    'S1 Terapan (D4) Teknologi Rekayasa Sistem Elektronika',
                    'S1 Terapan (D4) Teknologi Rekayasa Jaringan Telekomunikasi'
                ],
                'Bisnis dan Komunikasi': [
                    'S1 Terapan (D4) Akuntansi Perpajakan',
                    'S1 Terapan (D4) Bisnis Digital',
                    'S1 Terapan (D4) Hubungan Masyarakat dan Komunikasi Digital',
                    'S1 Terapan (D4) Animasi'
                ]
            };

            $('#department').change(function() {
                const selectedDepartment = $(this).val();
                const $studyProgramSelect = $('#study_program');
                $studyProgramSelect.empty();
                $studyProgramSelect.append('<option value="">Select Study Program</option>');

                if (selectedDepartment && studyPrograms[selectedDepartment]) {
                    studyPrograms[selectedDepartment].forEach(function(program) {
                        $studyProgramSelect.append('<option value="' + program + '">' + program + '</option>');
                    });
                }
            });

            // Trigger change on page load if department is pre-selected
            $('#department').trigger('change');
        });
    </script>
</body>

</html>
