import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm, Link } from '@inertiajs/react';

export default function Create({ students, courses }) {
    const { data, setData, post, processing, errors } = useForm({
        student_id: '',
        course_id:  '',
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post('/enrollments');
    };

    const inputStyle = {
        width: '100%',
        padding: '10px 12px',
        border: '1px solid #cbd5e1',
        borderRadius: '8px',
        fontSize: '14px',
        marginTop: '6px',
        boxSizing: 'border-box',
    };

    const errorStyle = { color: '#ef4444', fontSize: '12px', marginTop: '4px' };

    return (
        <AuthenticatedLayout header="📝 Enroll Student">
            <Head title="Enroll Student" />

            <div style={{ maxWidth: '560px', background: '#fff', borderRadius: '10px', padding: '24px', boxShadow: '0 1px 4px rgba(0,0,0,0.08)' }}>
                <form onSubmit={handleSubmit}>

                    {/* Student */}
                    <div style={{ marginBottom: '16px' }}>
                        <label style={{ fontSize: '14px', color: '#475569' }}>Select Student *</label>
                        <select
                            value={data.student_id}
                            onChange={e => setData('student_id', e.target.value)}
                            style={inputStyle}
                        >
                            <option value="">-- Select Student --</option>
                            {students.map(student => (
                                <option key={student.id} value={student.id}>
                                    {student.name}
                                </option>
                            ))}
                        </select>
                        {errors.student_id && <p style={errorStyle}>{errors.student_id}</p>}
                    </div>

                    {/* Course */}
                    <div style={{ marginBottom: '24px' }}>
                        <label style={{ fontSize: '14px', color: '#475569' }}>Select Course *</label>
                        <select
                            value={data.course_id}
                            onChange={e => setData('course_id', e.target.value)}
                            style={inputStyle}
                        >
                            <option value="">-- Select Course --</option>
                            {courses.map(course => (
                                <option key={course.id} value={course.id}>
                                    {course.name} — {course.teacher?.name ?? 'No Teacher'}
                                </option>
                            ))}
                        </select>
                        {errors.course_id && <p style={errorStyle}>{errors.course_id}</p>}
                    </div>

                    {/* Buttons */}
                    <div style={{ display: 'flex', gap: '12px' }}>
                        <button
                            type="submit"
                            disabled={processing}
                            style={{
                                background: '#3b82f6',
                                color: '#fff',
                                padding: '10px 24px',
                                borderRadius: '8px',
                                border: 'none',
                                cursor: 'pointer',
                                fontSize: '14px',
                                opacity: processing ? 0.7 : 1,
                            }}
                        >
                            {processing ? 'Enrolling...' : 'Enroll Student'}
                        </button>
                        <Link
                            href="/enrollments"
                            style={{
                                background: '#e2e8f0',
                                color: '#475569',
                                padding: '10px 24px',
                                borderRadius: '8px',
                                textDecoration: 'none',
                                fontSize: '14px',
                            }}
                        >
                            Cancel
                        </Link>
                    </div>

                </form>
            </div>
        </AuthenticatedLayout>
    );
}