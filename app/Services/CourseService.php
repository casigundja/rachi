<?php

namespace App\Services;

use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\CourseProgress;
use Exception;

class CourseService
{
    /**
     * Matricula o aluno e libera o curso (RN011).
     */
    public function enroll(int $courseId, int $customerId, ?int $orderId = null): CourseEnrollment
    {
        $existing = CourseEnrollment::where('course_id', $courseId)
            ->where('customer_id', $customerId)
            ->first();

        if ($existing) {
            return $existing;
        }

        return CourseEnrollment::create([
            'course_id' => $courseId,
            'customer_id' => $customerId,
            'order_id' => $orderId,
            'status' => 'active',
            'enrolled_at' => now(),
        ]);
    }

    /**
     * Marca uma aula como concluída e calcula progresso.
     */
    public function completeLesson(int $enrollmentId, int $lessonId): CourseProgress
    {
        $progress = CourseProgress::updateOrCreate(
            ['enrollment_id' => $enrollmentId, 'lesson_id' => $lessonId],
            [
                'completed' => true,
                'completed_at' => now(),
            ]
        );

        $enrollment = CourseEnrollment::findOrFail($enrollmentId);
        if ($enrollment->progress_percentage >= 100) {
            $enrollment->update([
                'status' => 'completed',
                'completed_at' => now(),
            ]);
        }

        return $progress;
    }
}
