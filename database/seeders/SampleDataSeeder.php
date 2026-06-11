<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Course;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        // ── Teachers + User accounts ───────────────────────────────
        $teachersData = [
            ['name' => 'Ahmed Benali',     'email' => 'ahmed.benali@school.com',     'phone' => '0612345678', 'subject' => 'Math'],
            ['name' => 'Fatima Zahra',     'email' => 'fatima.zahra@school.com',     'phone' => '0623456789', 'subject' => 'Physics'],
            ['name' => 'Youssef Alami',    'email' => 'youssef.alami@school.com',    'phone' => '0634567890', 'subject' => 'French'],
            ['name' => 'Nadia Chraibi',    'email' => 'nadia.chraibi@school.com',    'phone' => '0645678901', 'subject' => 'Biology'],
            ['name' => 'Karim Tazi',       'email' => 'karim.tazi@school.com',       'phone' => '0656789012', 'subject' => 'Informatique'],
            ['name' => 'Samira Ouazzani',  'email' => 'samira.ouazzani@school.com',  'phone' => '0667890123', 'subject' => 'Chemistry'],
            ['name' => 'Hassan Filali',    'email' => 'hassan.filali@school.com',    'phone' => '0678901234', 'subject' => 'Arabic'],
            ['name' => 'Laila Bennani',    'email' => 'laila.bennani@school.com',    'phone' => '0689012345', 'subject' => 'English'],
            ['name' => 'Omar Idrissi',     'email' => 'omar.idrissi@school.com',     'phone' => '0690123456', 'subject' => 'History'],
            ['name' => 'Zineb Berrada',    'email' => 'zineb.berrada@school.com',    'phone' => '0601234567', 'subject' => 'Philosophy'],
        ];

        $teachers = [];
        foreach ($teachersData as $data) {
            $user = User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name'     => $data['name'],
                    'password' => Hash::make('teacher123'),
                    'role'     => 'teacher',
                ]
            );
            $teacher = Teacher::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name'    => $data['name'],
                    'phone'   => $data['phone'],
                    'subject' => $data['subject'],
                    'image'   => 'default.jpg',
                    'user_id' => $user->id,
                ]
            );
            $teachers[$data['subject']] = $teacher;
        }
        $this->command->info('✅ Teachers: ' . count($teachersData));

        // ── Students ───────────────────────────────────────────────
        $studentsData = [
            // Math (6 students)
            ['name' => 'Ali Hassan',         'email' => 'ali.hassan@student.com',         'phone' => '0611000001', 'section' => 'Math'],
            ['name' => 'Sara Moussaoui',      'email' => 'sara.moussaoui@student.com',     'phone' => '0611000002', 'section' => 'Math'],
            ['name' => 'Khalid Amrani',       'email' => 'khalid.amrani@student.com',      'phone' => '0611000003', 'section' => 'Math'],
            ['name' => 'Houda Bensouda',      'email' => 'houda.bensouda@student.com',     'phone' => '0611000004', 'section' => 'Math'],
            ['name' => 'Tariq Ziani',         'email' => 'tariq.ziani@student.com',        'phone' => '0611000005', 'section' => 'Math'],
            ['name' => 'Meryem Tahiri',       'email' => 'meryem.tahiri@student.com',      'phone' => '0611000006', 'section' => 'Math'],
            // Physics (5 students)
            ['name' => 'Omar Idrissi',        'email' => 'omar.idrissi@student.com',       'phone' => '0611000007', 'section' => 'Physics'],
            ['name' => 'Leila Bakkali',       'email' => 'leila.bakkali@student.com',      'phone' => '0611000008', 'section' => 'Physics'],
            ['name' => 'Yassine Cherkaoui',   'email' => 'yassine.cherkaoui@student.com',  'phone' => '0611000009', 'section' => 'Physics'],
            ['name' => 'Nour Eddine Fassi',   'email' => 'nour.fassi@student.com',         'phone' => '0611000010', 'section' => 'Physics'],
            ['name' => 'Imane Bouazza',       'email' => 'imane.bouazza@student.com',      'phone' => '0611000011', 'section' => 'Physics'],
            // French (4 students)
            ['name' => 'Hamza Filali',        'email' => 'hamza.filali@student.com',       'phone' => '0611000012', 'section' => 'French'],
            ['name' => 'Rim Berrada',         'email' => 'rim.berrada@student.com',        'phone' => '0611000013', 'section' => 'French'],
            ['name' => 'Soukaina Lahlou',     'email' => 'soukaina.lahlou@student.com',    'phone' => '0611000014', 'section' => 'French'],
            ['name' => 'Adil Mansouri',       'email' => 'adil.mansouri@student.com',      'phone' => '0611000015', 'section' => 'French'],
            // Biology (4 students)
            ['name' => 'Anas Kettani',        'email' => 'anas.kettani@student.com',       'phone' => '0611000016', 'section' => 'Biology'],
            ['name' => 'Zineb Ouali',         'email' => 'zineb.ouali@student.com',        'phone' => '0611000017', 'section' => 'Biology'],
            ['name' => 'Rachid Benkirane',    'email' => 'rachid.benkirane@student.com',   'phone' => '0611000018', 'section' => 'Biology'],
            ['name' => 'Fatima Ait Said',     'email' => 'fatima.aitsaid@student.com',     'phone' => '0611000019', 'section' => 'Biology'],
            // Informatique (5 students)
            ['name' => 'Mehdi Lahlou',        'email' => 'mehdi.lahlou@student.com',       'phone' => '0611000020', 'section' => 'Informatique'],
            ['name' => 'Dounia Mansouri',     'email' => 'dounia.mansouri@student.com',    'phone' => '0611000021', 'section' => 'Informatique'],
            ['name' => 'Badr Eddine Raji',    'email' => 'badr.raji@student.com',          'phone' => '0611000022', 'section' => 'Informatique'],
            ['name' => 'Hajar Benali',        'email' => 'hajar.benali@student.com',       'phone' => '0611000023', 'section' => 'Informatique'],
            ['name' => 'Othmane Squalli',     'email' => 'othmane.squalli@student.com',    'phone' => '0611000024', 'section' => 'Informatique'],
            // Chemistry (3 students)
            ['name' => 'Salma Tazi',          'email' => 'salma.tazi@student.com',         'phone' => '0611000025', 'section' => 'Chemistry'],
            ['name' => 'Kamal Ouazzani',      'email' => 'kamal.ouazzani@student.com',     'phone' => '0611000026', 'section' => 'Chemistry'],
            ['name' => 'Nadia Alaoui',        'email' => 'nadia.alaoui@student.com',       'phone' => '0611000027', 'section' => 'Chemistry'],
            // Arabic (3 students)
            ['name' => 'Abdelaziz Hajji',     'email' => 'abdelaziz.hajji@student.com',    'phone' => '0611000028', 'section' => 'Arabic'],
            ['name' => 'Khadija Bennis',      'email' => 'khadija.bennis@student.com',     'phone' => '0611000029', 'section' => 'Arabic'],
            ['name' => 'Mouad Chraibi',       'email' => 'mouad.chraibi@student.com',      'phone' => '0611000030', 'section' => 'Arabic'],
            // English (3 students)
            ['name' => 'Yasmine Sefrioui',    'email' => 'yasmine.sefrioui@student.com',   'phone' => '0611000031', 'section' => 'English'],
            ['name' => 'Ilyas Bensouda',      'email' => 'ilyas.bensouda@student.com',     'phone' => '0611000032', 'section' => 'English'],
            ['name' => 'Rania Kettani',       'email' => 'rania.kettani@student.com',      'phone' => '0611000033', 'section' => 'English'],
            // History (3 students)
            ['name' => 'Saad Filali',         'email' => 'saad.filali@student.com',        'phone' => '0611000034', 'section' => 'History'],
            ['name' => 'Loubna Amrani',       'email' => 'loubna.amrani@student.com',      'phone' => '0611000035', 'section' => 'History'],
            ['name' => 'Amine Ziani',         'email' => 'amine.ziani@student.com',        'phone' => '0611000036', 'section' => 'History'],
            // Philosophy (2 students)
            ['name' => 'Chaimae Bensaid',     'email' => 'chaimae.bensaid@student.com',    'phone' => '0611000037', 'section' => 'Philosophy'],
            ['name' => 'Hamid Laroui',        'email' => 'hamid.laroui@student.com',       'phone' => '0611000038', 'section' => 'Philosophy'],
        ];

        $students = [];
        foreach ($studentsData as $data) {
            $teacherForSection = $teachers[$data['section']] ?? null;
            $student = Student::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name'       => $data['name'],
                    'phone'      => $data['phone'],
                    'section'    => $data['section'],
                    'image'      => 'default.jpg',
                    'teacher_id' => $teacherForSection?->id,
                ]
            );
            $students[$data['email']] = $student;
        }
        $this->command->info('✅ Students: ' . count($studentsData));

        // ── Courses ────────────────────────────────────────────────
        $coursesData = [
            ['name' => 'Math',        'description' => 'Algebra, calculus and geometry',        'schedule' => 'Monday 08h-10h',     'room' => 'Salle 01', 'subject' => 'Math'],
            ['name' => 'Physics',     'description' => 'Mechanics, electricity and optics',     'schedule' => 'Tuesday 10h-12h',    'room' => 'Salle 02', 'subject' => 'Physics'],
            ['name' => 'French',      'description' => 'French language and literature',        'schedule' => 'Wednesday 08h-10h',  'room' => 'Salle 03', 'subject' => 'French'],
            ['name' => 'Biology',     'description' => 'Cell biology, genetics and ecology',    'schedule' => 'Thursday 14h-16h',   'room' => 'Salle 04', 'subject' => 'Biology'],
            ['name' => 'Informatique','description' => 'Programming, algorithms and networks',  'schedule' => 'Friday 10h-12h',     'room' => 'Salle 05', 'subject' => 'Informatique'],
            ['name' => 'Chemistry',   'description' => 'Organic and inorganic chemistry',       'schedule' => 'Monday 14h-16h',     'room' => 'Salle 06', 'subject' => 'Chemistry'],
            ['name' => 'Arabic',      'description' => 'Arabic language, grammar and poetry',   'schedule' => 'Tuesday 08h-10h',    'room' => 'Salle 07', 'subject' => 'Arabic'],
            ['name' => 'English',     'description' => 'English language and communication',    'schedule' => 'Wednesday 14h-16h',  'room' => 'Salle 08', 'subject' => 'English'],
            ['name' => 'History',     'description' => 'World history and civilizations',       'schedule' => 'Thursday 08h-10h',   'room' => 'Salle 09', 'subject' => 'History'],
            ['name' => 'Philosophy',  'description' => 'Logic, ethics and critical thinking',   'schedule' => 'Friday 14h-16h',     'room' => 'Salle 10', 'subject' => 'Philosophy'],
        ];

        $courses = [];
        foreach ($coursesData as $data) {
            $course = Course::updateOrCreate(
                ['name' => $data['name'], 'room' => $data['room']],
                [
                    'description' => $data['description'],
                    'schedule'    => $data['schedule'],
                    'teacher_id'  => $teachers[$data['subject']]->id ?? null,
                ]
            );
            $courses[$data['name']] = $course;
        }
        $this->command->info('✅ Courses: ' . count($coursesData));

        // ── Enrollments ────────────────────────────────────────────
        // Each student enrolled in their main course + 1-2 cross-enrollments
        $enrollments = [
            // Math students
            ['student' => 'ali.hassan@student.com',        'courses' => ['Math', 'Physics']],
            ['student' => 'sara.moussaoui@student.com',    'courses' => ['Math', 'French']],
            ['student' => 'khalid.amrani@student.com',     'courses' => ['Math', 'Informatique']],
            ['student' => 'houda.bensouda@student.com',    'courses' => ['Math', 'Chemistry']],
            ['student' => 'tariq.ziani@student.com',       'courses' => ['Math', 'Physics', 'English']],
            ['student' => 'meryem.tahiri@student.com',     'courses' => ['Math', 'Biology']],
            // Physics students
            ['student' => 'omar.idrissi@student.com',      'courses' => ['Physics', 'Math', 'Chemistry']],
            ['student' => 'leila.bakkali@student.com',     'courses' => ['Physics', 'Biology']],
            ['student' => 'yassine.cherkaoui@student.com', 'courses' => ['Physics', 'Math']],
            ['student' => 'nour.fassi@student.com',        'courses' => ['Physics', 'Chemistry']],
            ['student' => 'imane.bouazza@student.com',     'courses' => ['Physics', 'French']],
            // French students
            ['student' => 'hamza.filali@student.com',      'courses' => ['French', 'Arabic']],
            ['student' => 'rim.berrada@student.com',       'courses' => ['French', 'English', 'History']],
            ['student' => 'soukaina.lahlou@student.com',   'courses' => ['French', 'Philosophy']],
            ['student' => 'adil.mansouri@student.com',     'courses' => ['French', 'History']],
            // Biology students
            ['student' => 'anas.kettani@student.com',      'courses' => ['Biology', 'Chemistry']],
            ['student' => 'zineb.ouali@student.com',       'courses' => ['Biology', 'French']],
            ['student' => 'rachid.benkirane@student.com',  'courses' => ['Biology', 'Physics']],
            ['student' => 'fatima.aitsaid@student.com',    'courses' => ['Biology', 'Chemistry', 'Math']],
            // Informatique students
            ['student' => 'mehdi.lahlou@student.com',      'courses' => ['Informatique', 'Math']],
            ['student' => 'dounia.mansouri@student.com',   'courses' => ['Informatique', 'English']],
            ['student' => 'badr.raji@student.com',         'courses' => ['Informatique', 'Math', 'Physics']],
            ['student' => 'hajar.benali@student.com',      'courses' => ['Informatique', 'French']],
            ['student' => 'othmane.squalli@student.com',   'courses' => ['Informatique', 'Philosophy']],
            // Chemistry students
            ['student' => 'salma.tazi@student.com',        'courses' => ['Chemistry', 'Biology', 'Physics']],
            ['student' => 'kamal.ouazzani@student.com',    'courses' => ['Chemistry', 'Math']],
            ['student' => 'nadia.alaoui@student.com',      'courses' => ['Chemistry', 'Biology']],
            // Arabic students
            ['student' => 'abdelaziz.hajji@student.com',   'courses' => ['Arabic', 'History']],
            ['student' => 'khadija.bennis@student.com',    'courses' => ['Arabic', 'French', 'Philosophy']],
            ['student' => 'mouad.chraibi@student.com',     'courses' => ['Arabic', 'History']],
            // English students
            ['student' => 'yasmine.sefrioui@student.com',  'courses' => ['English', 'French']],
            ['student' => 'ilyas.bensouda@student.com',    'courses' => ['English', 'Informatique']],
            ['student' => 'rania.kettani@student.com',     'courses' => ['English', 'History', 'Philosophy']],
            // History students
            ['student' => 'saad.filali@student.com',       'courses' => ['History', 'Arabic']],
            ['student' => 'loubna.amrani@student.com',     'courses' => ['History', 'French']],
            ['student' => 'amine.ziani@student.com',       'courses' => ['History', 'Philosophy']],
            // Philosophy students
            ['student' => 'chaimae.bensaid@student.com',   'courses' => ['Philosophy', 'French', 'History']],
            ['student' => 'hamid.laroui@student.com',      'courses' => ['Philosophy', 'Arabic']],
        ];

        $enrollCount = 0;
        foreach ($enrollments as $e) {
            $student = $students[$e['student']] ?? null;
            if (!$student) continue;
            foreach ($e['courses'] as $courseName) {
                $course = $courses[$courseName] ?? null;
                if ($course) {
                    $course->students()->syncWithoutDetaching([$student->id]);
                    $enrollCount++;
                }
            }
        }
        $this->command->info('✅ Enrollments: ' . $enrollCount);
        $this->command->info('');
        $this->command->info('All teacher logins use password: teacher123');
    }
}
