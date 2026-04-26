import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link, router } from '@inertiajs/react';

export default function Index({ enrollments, flash }) {
    const handleDelete = (id) => {
        if (confirm('Are you sure you want to remove this enrollment?')) {
            router.delete(`/enrollments/${id}`);
        }
    };

    return (
        <AuthenticatedLayout header="📝 Enrollments">
            <Head title="Enrollments" />

            {/* Success Message */}
            {flash?.success && (
                <div style={{
                    background: '#dcfce7',
                    color: '#166534',
                    padding: '12px 16px',
                    borderRadius: '8px',
                    marginBottom: '16px',
                }}>
                    ✅ {flash.success}
                </div>
            )}

            {/* Add Button */}
            <div style={{ marginBottom: '16px' }}>
                <Link
                    href="/enrollments/create"
                    style={{
                        background: '#3b82f6',
                        color: '#fff',
                        padding: '10px 20px',
                        borderRadius: '8px',
                        textDecoration: 'none',
                        fontSize: '14px',
                    }}
                >
                    + Enroll Student
                </Link>
            </div>

            {/* Table */}
            <div style={{ background: '#fff', borderRadius: '10px', overflow: 'hidden', boxShadow: '0 1px 4px rgba(0,0,0,0.08)' }}>
                <table style={{ width: '100%', borderCollapse: 'collapse', fontSize: '14px' }}>
                    <thead style={{ background: '#f1f5f9' }}>
                        <tr>
                            {['#', 'Student', 'Course', 'Teacher', 'Action'].map(h => (
                                <th key={h} style={{ padding: '12px 16px', textAlign: 'left', color: '#475569' }}>{h}</th>
                            ))}
                        </tr>
                    </thead>
                    <tbody>
                        {enrollments.length === 0 ? (
                            <tr>
                                <td colSpan="5" style={{ padding: '20px', textAlign: 'center', color: '#94a3b8' }}>
                                    No enrollments found.
                                </td>
                            </tr>
                        ) : (
                            enrollments.map((enrollment, index) => (
                                <tr key={enrollment.id} style={{ borderTop: '1px solid #e2e8f0' }}>
                                    <td style={{ padding: '12px 16px' }}>{index + 1}</td>
                                    <td style={{ padding: '12px 16px' }}>{enrollment.student?.name ?? '—'}</td>
                                    <td style={{ padding: '12px 16px' }}>{enrollment.course?.name ?? '—'}</td>
                                    <td style={{ padding: '12px 16px' }}>{enrollment.course?.teacher?.name ?? '—'}</td>
                                    <td style={{ padding: '12px 16px' }}>
                                        <button
                                            onClick={() => handleDelete(enrollment.id)}
                                            style={{
                                                background: '#ef4444',
                                                color: '#fff',
                                                padding: '6px 12px',
                                                borderRadius: '6px',
                                                border: 'none',
                                                cursor: 'pointer',
                                                fontSize: '13px',
                                            }}
                                        >
                                            Remove
                                        </button>
                                    </td>
                                </tr>
                            ))
                        )}
                    </tbody>
                </table>
            </div>
        </AuthenticatedLayout>
    );
}