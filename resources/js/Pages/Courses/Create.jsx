import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm, Link } from '@inertiajs/react';

export default function Create({ teachers }) {
    const { data, setData, post, processing, errors } = useForm({
        name:        '',
        description: '',
        teacher_id:  '',
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post('/courses');
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
        <AuthenticatedLayout header="📚 Add Course">
            <Head title="Add Course" />

            <div style={{ maxWidth: '560px', background: '#fff', borderRadius: '10px', padding: '24px', boxShadow: '0 1px 4px rgba(0,0,0,0.08)' }}>
                <form onSubmit={handleSubmit}>

                    {/* Course Name */}
                    <div style={{ marginBottom: '16px' }}>
                        <label style={{ fontSize: '14px', color: '#475569' }}>Course Name *</label>
                        <input
                            type="text"
                            value={data.name}
                            onChange={e => setData('name', e.target.value)}
                            style={inputStyle}
                            placeholder="Enter course name"
                        />
                        {errors.name && <p style={errorStyle}>{errors.name}</p>}
                    </div>

                    {/* Teacher */}
                    <div style={{ marginBottom: '16px' }}>
                        <label style={{ fontSize: '14px', color: '#475569' }}>Assign Teacher *</label>
                        <select
                            value={data.teacher_id}
                            onChange={e => setData('teacher_id', e.target.value)}
                            style={inputStyle}
                        >
                            <option value="">-- Select Teacher --</option>
                            {teachers.map(teacher => (
                                <option key={teacher.id} value={teacher.id}>
                                    {teacher.name}
                                </option>
                            ))}
                        </select>
                        {errors.teacher_id && <p style={errorStyle}>{errors.teacher_id}</p>}
                    </div>

                    {/* Description */}
                    <div style={{ marginBottom: '24px' }}>
                        <label style={{ fontSize: '14px', color: '#475569' }}>Description</label>
                        <textarea
                            value={data.description}
                            onChange={e => setData('description', e.target.value)}
                            style={{ ...inputStyle, height: '80px', resize: 'vertical' }}
                            placeholder="Enter course description"
                        />
                        {errors.description && <p style={errorStyle}>{errors.description}</p>}
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
                            {processing ? 'Saving...' : 'Save Course'}
                        </button>
                        <Link
                            href="/courses"
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